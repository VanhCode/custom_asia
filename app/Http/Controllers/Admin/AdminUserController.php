<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Role;
use App\Models\RoleAdmin;
use App\Traits\DeleteRecordTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\Admin\ValidateAddAdminUser;
use App\Traits\StorageImageTrait;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\ValidateEditAdminUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class AdminUserController extends Controller
{
    //
    use StorageImageTrait, DeleteRecordTrait;
    private $admin;
    private $role;
    private $roleAdmin;
    public function __construct(Admin $admin, Role $role, RoleAdmin $roleAdmin)
    {
        $this->admin = $admin;
        $this->role = $role;
        $this->roleAdmin = $roleAdmin;
    }
    public function index()
    {
        if (Auth::guard('admin')->user()->id == 2) {
            $data = $this->admin->where('id', '<>', 7)->orderBy("created_at", "desc")->paginate(15);
        } else {
            $data = $this->admin->where('id', '<>', 2)->orderBy("created_at", "desc")->paginate(15);
        }
        return view(
            "admin.pages.user.list",
            [
                'data' => $data
            ]
        );
    }
    public function create(Request $request = null)
    {
        $dataRoles = $this->role->all();
        return view(
            "admin.pages.user.add",
            [
                'request' => $request,
                'dataRoles' => $dataRoles,
            ]
        );
    }
    public function store(ValidateAddAdminUser $request)
    {
        // dd($request->all());x
        try {
            DB::beginTransaction();
            $name = $request->input('name');

            // Xử lý chuỗi để chuyển thành dạng không dấu và viết thường
            // $processedName = strtolower(str_replace(' ', '', $name));
            $processedName = Str::slug($name, '-');
            $dataAdminUserCreate = [
                "name" => $request->input('name'),
                "name_short" => $processedName,
                "email" => $request->input('email'),
                "title_seo" => $request->input('title_seo'),
                "description_seo" => $request->input('description_seo'),
                "keyword_seo" => $request->input('keyword_seo'),
                "password" => Hash::make($request->input('password')),
                "description" => $request->input('description'),
                "active" => $request->input('active'),
            ];

            $dataUploadAvatar = $this->storageTraitUpload($request, "avatar_path", "admins");
            // dd( $dataUploadAvatar);
            if (!empty($dataUploadAvatar)) {
                $dataAdminUserCreate["avatar_path"] = $dataUploadAvatar["file_path"];
            }

            $admin = $this->admin->create($dataAdminUserCreate);
            // insert database to product_tags table
            if ($request->has("role_id")) {
                $role_ids = $request->role_id;
                $admin->getRoles()->attach($role_ids);
            }
            DB::commit();
            return redirect()->route('admin.user.create')->with("alert", "Thêm admin user thành công");
        } catch (\Exception $exception) {
            //throw $th;
            DB::rollBack();
            Log::error('message' . $exception->getMessage() . 'line :' . $exception->getLine());
            return redirect()->route('admin.user.create')->with("error", "Thêm admin user không thành công");
        }
    }
    public function edit($id)
    {
        $data = $this->admin->find($id);
        $dataRoles = $this->role->all();
        $dataRolesOfUser = $data->getRoles();
        return view("admin.pages.user.edit", [
            'data' => $data,
            'dataRoles' => $dataRoles,
            'dataRolesOfUser' => $dataRolesOfUser,
        ]);
    }

    public function update(ValidateEditAdminUser $request, $id)
    {
        try {
            DB::beginTransaction();
            $dataAdminUserUpdate = [
                "name" => $request->input('name'),
                "description" => $request->input('description'),
                "title_seo" => $request->input('title_seo'),
                "description_seo" => $request->input('description_seo'),
                "keyword_seo" => $request->input('keyword_seo'),
                "email" => $request->input('email'),
                "active" => $request->input('active'),
            ];
            if (request()->has('password')) {
                $dataAdminUserUpdate['password'] = Hash::make($request->input('password'));
            }

            $dataUploadAvatar = $this->storageTraitUpload($request, "avatar_path", "admins");
            if (!empty($dataUploadAvatar)) {
                $path = $this->admin->find($id)->avatar_path;
                if ($path) {
                    Storage::delete($this->makePathDelete($path));
                }
                $dataAdminUserUpdate["avatar_path"] = $dataUploadAvatar["file_path"];
            }

            $this->admin->find($id)->update($dataAdminUserUpdate);
            $admin = $this->admin->find($id);

            // insert database to role_users table
            if ($request->has("role_id")) {
                $role_ids = $request->role_id;
                // Các syncphương pháp chấp nhận một loạt các ID để ra trên bảng trung gian. Bất kỳ ID nào không nằm trong mảng đã cho sẽ bị xóa khỏi bảng trung gian.
                $admin->getRoles()->sync($role_ids);
            }
            DB::commit();
            return redirect()->route('admin.user.index')->with("alert", "Sửa admin user thành công");
        } catch (\Exception $exception) {
            //throw $th;
            DB::rollBack();
            Log::error('message' . $exception->getMessage() . 'line :' . $exception->getLine());
            return redirect()->route('admin.user.index')->with("error", "Sửa admin user không thành công");
        }
    }

    public function destroy($id)
    {
        return $this->deleteTrait($this->admin, $id);
    }
}
