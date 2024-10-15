<?php

namespace App\Http\Controllers\Admin;

use App\Models\AdditionalFee;
use Illuminate\Http\Request;
use App\Helper\MessageHelper;
use App\Traits\TransactionService;
use App\Http\Controllers\Controller;

class AdditionalFeeController extends Controller
{
    use TransactionService;

    protected $additionalFee;

    public function __construct(AdditionalFee $additionalFee)
    {
        $this->additionalFee = $additionalFee;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $serviceOthers = $this->additionalFee->orderBy('order', 'desc')->paginate(15)->withQueryString();
        return view('admin.pages.additional-fee.index', compact('serviceOthers'));
    }

    public function create()
    {
        return view('admin.pages.additional-fee.create');
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
                'price' => 'required',
            ],
            [
                'required' => 'The field is required.',
            ]
        );
        $this->execute(function () use ($request) {
            $data = [
                'name' => $request->name,
                'price' => $request->price,
                'active' => $request->active,
                'order' => $request->order,
                'description' => $request->description,
            ];

            $this->additionalFee->create($data);
        });
        return redirect()->route('admin.additional-fee.index')->with('alert', config('ajax.messages.success.created'));
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
        $additionalFee = $this->additionalFee->find($id);
        return view('admin.pages.additional-fee.edit', compact('additionalFee'));
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
                'price' => 'required',
            ],
            [
                'required' => 'The field is required.',
            ]
        );
        $this->execute(function () use ($request, $id) {
            $data = [
                'name' => $request->name,
                'price' => $request->price,
                'active' => $request->active,
                'order' => $request->order,
                'description' => $request->description,
            ];

            $this->additionalFee->where('id', $id)->update($data);
        });
        return redirect()->route('admin.additional-fee.index')->with(
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
            $this->additionalFee->where('id', $id)->delete();
        });

        return MessageHelper::success(
            config('ajax.messages.success.deleted'),
            config('ajax.status.success.deleted')
        );
    }

    public function changeActive($id)
    {
        $this->execute(function () use ($id) {
            $additionalFee = $this->additionalFee->find($id);
            $additionalFee->update(['active' => (int) !$additionalFee->active]);
        });
        return MessageHelper::success(
            config('ajax.messages.success.updated'),
            config('ajax.status.success.updated')
        );
    }

    public function changeOrder($id, Request $request)
    {
        $this->execute(function () use ($request, $id) {
            $additionalFee = $this->additionalFee->find($id);
            $additionalFee->update(['order' => $request->order]);
        });
        return MessageHelper::success(
            config('ajax.messages.success.updated'),
            config('ajax.status.success.updated')
        );
    }
}
