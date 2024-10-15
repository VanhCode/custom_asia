<?php

namespace App\Http\Controllers\Admin;

use App\Models\ServiceClass;
use Illuminate\Http\Request;
use App\Helper\MessageHelper;
use App\Traits\TransactionService;
use App\Http\Controllers\Controller;

class ServiceClassController extends Controller
{
    use TransactionService;

    protected $serviceClass;

    public function __construct(ServiceClass $serviceClass)
    {
        $this->serviceClass = $serviceClass;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $serviceClasses = $this->serviceClass->orderBy('order', 'desc')->paginate(15)->withQueryString();
        return view('admin.pages.service-class.index', compact('serviceClasses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.service-class.create');
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

            $this->serviceClass->create($data);
        });
        return redirect()->route('admin.service-class.index')->with('alert', config('ajax.messages.success.created'));
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
        $serviceClass = $this->serviceClass->find($id);
        return view('admin.pages.service-class.edit', compact('serviceClass'));
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

            $this->serviceClass->where('id', $id)->update($data);
        });
        return redirect()->route('admin.service-class.index')->with(
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
            $this->serviceClass->where('id', $id)->delete();
        });

        return MessageHelper::success(
            config('ajax.messages.success.deleted'),
            config('ajax.status.success.deleted')
        );
    }

    public function changeActive($id)
    {
        $this->execute(function () use ($id) {
            $serviceClass = $this->serviceClass->find($id);
            $serviceClass->update(['active' => (int) !$serviceClass->active]);
        });
        return MessageHelper::success(
            config('ajax.messages.success.updated'),
            config('ajax.status.success.updated')
        );
    }

    public function changeOrder($id, Request $request)
    {
        $this->execute(function () use ($request, $id) {
            $serviceClass = $this->serviceClass->find($id);
            $serviceClass->update(['order' => $request->order]);
        });
        return MessageHelper::success(
            config('ajax.messages.success.updated'),
            config('ajax.status.success.updated')
        );
    }
}
