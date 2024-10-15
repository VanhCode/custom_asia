<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Helper\MessageHelper;
use App\Models\ServiceSeason;
use App\Traits\TransactionService;
use App\Http\Controllers\Controller;

class ServiceSeasonController extends Controller
{
    use TransactionService;

    protected $serviceSeason;

    public function __construct(ServiceSeason $serviceSeason)
    {
        $this->serviceSeason = $serviceSeason;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->service_id) {
            return MessageHelper::error('Please select service', 400);
        }
        $this->execute(function () use ($request) {
            $data = [
                'name' => $request->name,
                'date_from' => Carbon::createFromFormat('Y-m-d', $request->date_from)->startOfDay(),
                'date_to' => Carbon::createFromFormat('Y-m-d', $request->date_to)->startOfDay(),
                'service_id' => $request->service_id
            ];
            $this->serviceSeason->create($data);
        });

        return MessageHelper::success('Season created successfully', 201);
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
        //
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
        $this->execute(function () use ($request, $id) {
            $data = [
                'name' => $request->name,
                'date_from' => Carbon::createFromFormat('Y-m-d', $request->date_from)->startOfDay(),
                'date_to' => Carbon::createFromFormat('Y-m-d', $request->date_to)->startOfDay()
            ];
            $this->serviceSeason->where('id', $id)->update($data);
        });

        return MessageHelper::success('Season updated successfully', 200);
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
            $season = $this->serviceSeason->find($id);
            $season->services()->delete();
            $season->delete();
        });

        return MessageHelper::success('Season deleted successfully', 200);
    }
}
