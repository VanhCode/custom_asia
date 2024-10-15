<?php

namespace App\Http\Controllers\Admin;

use App\Models\ServiceFull;
use Illuminate\Http\Request;
use App\Helper\MessageHelper;
use App\Traits\TransactionService;
use App\Http\Controllers\Controller;

class ServiceFullController extends Controller
{
    use TransactionService;

    protected $service;

    public function __construct(ServiceFull $service)
    {
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $parent_id = $request->input('parent_id') ?? 0;
        $parent = $parent_id ? $this->service->find($parent_id) : null;
        $services = $this->service->where('parent_id', $parent_id)->orderBy('order', 'desc')->paginate(15)->withQueryString();
        return view('admin.pages.service-full.index', compact('services', 'parent'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $parent = $request->input('parent_id') ?
            $this->service->find($request->input('parent_id')) : null;
        return view('admin.pages.service-full.create', compact('parent'));
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
                'parent_id' => $request->parent_id ?? 0,
                'description' => $request->description,
            ];

            $this->service->create($data);
        });
        return redirect()->route('admin.service-full.index', ['parent_id' => $request->parent_id])->with('alert', config('ajax.messages.success.created'));
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
        $service = $this->service->find($id);
        $parent = $service->parent_id ?
            $this->service->find($service->parent_id) : null;
        return view('admin.pages.service-full.edit', compact('service', 'parent'));
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

            $this->service->where('id', $id)->update($data);
        });
        return redirect()->route('admin.service-full.index')->with(
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
            $service = $this->service->find($id);
            $service->children()->delete();
            $service->delete();
        });

        return MessageHelper::success(
            config('ajax.messages.success.deleted'),
            config('ajax.status.success.deleted')
        );
    }

    public function changeActive($id)
    {
        $this->execute(function () use ($id) {
            $service = $this->service->find($id);
            $service->update(['active' => (int) !$service->active]);
        });
        return MessageHelper::success(
            config('ajax.messages.success.updated'),
            config('ajax.status.success.updated')
        );
    }

    public function changeOrder($id, Request $request)
    {
        $this->execute(function () use ($request, $id) {
            $service = $this->service->find($id);
            $service->update(['order' => $request->order]);
        });
        return MessageHelper::success(
            config('ajax.messages.success.updated'),
            config('ajax.status.success.updated')
        );
    }

    public function getServiceChild($id)
    {
        $serviceFullTour = $this->service->where('parent_id', $id)->get()->toArray();

        return MessageHelper::success('Get service child success', 200, $serviceFullTour);
    }
}
