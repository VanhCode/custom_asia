<?php

namespace App\Http\Controllers\Admin;

use App\Models\ServiceType;
use Illuminate\Http\Request;
use App\Helper\MessageHelper;
use App\Traits\TransactionService;
use App\Http\Controllers\Controller;

class ServiceTypeController extends Controller
{
    use TransactionService;

    protected $serviceType;

    public function __construct(ServiceType $serviceType)
    {
        $this->serviceType = $serviceType;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $serviceTypes = $this->serviceType->orderBy('order', 'desc')->paginate(15)->withQueryString();
        return view('admin.pages.service-type.index', compact('serviceTypes'));
    }

    public function create()
    {
        return view('admin.pages.service-type.create');
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

            $this->serviceType->create($data);
        });
        return redirect()->route('admin.service-type.index')->with('alert', config('ajax.messages.success.created'));
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
        $serviceType = $this->serviceType->find($id);
        return view('admin.pages.service-type.edit', compact('serviceType'));
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

            $this->serviceType->where('id', $id)->update($data);
        });
        return redirect()->route('admin.service-type.index')->with(
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
            $this->serviceType->where('id', $id)->delete();
        });

        return MessageHelper::success(
            config('ajax.messages.success.deleted'),
            config('ajax.status.success.deleted')
        );
    }

    public function changeActive($id)
    {
        $this->execute(function () use ($id) {
            $serviceType = $this->serviceType->find($id);
            $serviceType->update(['active' => (int) !$serviceType->active]);
        });
        return MessageHelper::success(
            config('ajax.messages.success.updated'),
            config('ajax.status.success.updated')
        );
    }

    public function changeOrder($id, Request $request)
    {
        $this->execute(function () use ($request, $id) {
            $serviceType = $this->serviceType->find($id);
            $serviceType->update(['order' => $request->order]);
        });
        return MessageHelper::success(
            config('ajax.messages.success.updated'),
            config('ajax.status.success.updated')
        );
    }
}
