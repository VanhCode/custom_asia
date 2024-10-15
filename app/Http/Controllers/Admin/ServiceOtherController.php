<?php

namespace App\Http\Controllers\Admin;

use App\Models\ServiceOther;
use Illuminate\Http\Request;
use App\Helper\MessageHelper;
use App\Traits\TransactionService;
use App\Http\Controllers\Controller;

class ServiceOtherController extends Controller
{
    use TransactionService;

    protected $serviceOther;

    public function __construct(ServiceOther $serviceOther)
    {
        $this->serviceOther = $serviceOther;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $serviceOthers = $this->serviceOther->orderBy('order', 'desc')->paginate(15)->withQueryString();
        return view('admin.pages.service-other.index', compact('serviceOthers'));
    }

    public function create()
    {
        return view('admin.pages.service-other.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
            ],
            [
                'required' => 'The field is required.',
            ]
        );
        $this->execute(function () use ($request) {
            $data = [
                'name' => $request->name,
                'active' => $request->active,
                'order' => $request->order,
                'description' => $request->description,
            ];

            $this->serviceOther->create($data);
        });
        return redirect()->route('admin.service-other.index')->with('alert', config('ajax.messages.success.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $serviceOther = $this->serviceOther->find($id);
        return view('admin.pages.service-other.edit', compact('serviceOther'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required',
            ],
            [
                'required' => 'The field is required.',
            ]
        );
        $this->execute(function () use ($request, $id) {
            $data = [
                'name' => $request->name,
                'active' => $request->active,
                'order' => $request->order,
                'description' => $request->description,
            ];

            $this->serviceOther->where('id', $id)->update($data);
        });
        return redirect()->route('admin.service-other.index')->with(
            'alert',
            config('ajax.messages.success.updated')
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->execute(function () use ($id) {
            $this->serviceOther->where('id', $id)->delete();
        });

        return MessageHelper::success(
            config('ajax.messages.success.deleted'),
            config('ajax.status.success.deleted')
        );
    }

    public function changeActive($id)
    {
        $this->execute(function () use ($id) {
            $serviceOther = $this->serviceOther->find($id);
            $serviceOther->update(['active' => (int) !$serviceOther->active]);
        });
        return MessageHelper::success(
            config('ajax.messages.success.updated'),
            config('ajax.status.success.updated')
        );
    }

    public function changeOrder($id, Request $request)
    {
        $this->execute(function () use ($request, $id) {
            $serviceOther = $this->serviceOther->find($id);
            $serviceOther->update(['order' => $request->order]);
        });
        return MessageHelper::success(
            config('ajax.messages.success.updated'),
            config('ajax.status.success.updated')
        );
    }
}
