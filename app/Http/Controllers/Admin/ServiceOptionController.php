<?php

namespace App\Http\Controllers\Admin;

use App\Models\ServiceClass;
use App\Models\ServiceInformation;
use Carbon\Carbon;
use App\Models\Service;
use App\Models\ServiceType;
use Illuminate\Http\Request;
use App\Helper\MessageHelper;
use App\Models\ServiceOption;
use App\Models\ServiceSeason;
use App\Traits\TransactionService;
use App\Http\Controllers\Controller;

class ServiceOptionController extends Controller
{
    use TransactionService;

    protected $service;
    protected $serviceType;
    protected $serviceOption;

    protected $serviceClass;

    protected $serviceInformation;

    public function __construct(
        Service $service,
        ServiceType $serviceType,
        ServiceOption $serviceOption,
        ServiceClass $serviceClass,
        ServiceInformation $serviceInformation
    )
    {
        $this->service = $service;
        $this->serviceType = $serviceType;
        $this->serviceOption = $serviceOption;
        $this->serviceClass = $serviceClass;
        $this->serviceInformation = $serviceInformation;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->input('service_id')) {
            $service = $this->service->find($request->input('service_id'));

            if (!$service) {
                return abort(404);
            }

            $serviceClass = $this->serviceClass->all();

            $serviceInformation = $this->serviceInformation->where('service_id', $request->input('service_id'))->first();

            return view('admin.pages.service-option.index', compact('service', 'serviceClass', 'serviceInformation'));
        }
        return abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $service_id = $request->input('service_id');
        $service_season_id = $request->input('service_season_id');
        $servicesType = $this->serviceType->get();


        if (!$service_id || !$service_season_id) {
            return abort(404);
        }
        return view('admin.pages.service-option.create', compact('service_id', 'service_season_id', 'servicesType'));
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
                'type' => 'required',
            ],
            [
                'required' => 'The field is required.',
            ]
        );
        $this->execute(function () use ($request) {
            $data = [
                'name' => $request->name,
                'type' => $request->type,
                'price' => $request->price,
                'description' => $request->description,
                'service_id' => $request->service_id,
                'service_type_id' => $request->service_type_id,
                'service_season_id' => $request->service_season_id
            ];
            $this->serviceOption->create($data);
        });
        return redirect()->route('admin.service-option.index', ['service_id' => $request->service_id, 'service_season_id' => $request->service_season_id])->with('alert', config('ajax.messages.success.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function saveInformation(Request $request)
    {
        $this->execute(function () use ($request) {

            if (empty($request->service_information_id)) {
                $data = [
                    'service_id' => $request->service_id,
                    'city_id' => $request->city_id,
                    'district_id' => $request->district_id,
                    'service_class_id' => $request->service_class_id,
                    'text1' => $request->text1,
                    'text2' => $request->text2
                ];

                $this->serviceInformation->create($data);
            } else {
                $data = [
                    'service_id' => $request->service_id,
                    'city_id' => $request->city_id,
                    'district_id' => $request->district_id,
                    'service_class_id' => $request->service_class_id,
                    'text1' => $request->text1,
                    'text2' => $request->text2
                ];

                $this->serviceInformation->where('id', $request->service_information_id)->where('service_id', $request->service_id)->update($data);
            }
        });

        return redirect()->route('admin.service-option.index', ['service_id' => $request->service_id])->with('alert', config('ajax.messages.success.created'));
    }

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
        $serviceOption = $this->serviceOption->find($id);
        $servicesType = $this->serviceType->get();
        if (!$serviceOption) {
            return abort(404);
        }
        return view('admin.pages.service-option.edit', compact('serviceOption', 'servicesType'));
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
                'type' => 'required',
            ],
            [
                'required' => 'The field is required.',
            ]
        );
        $serviceOption = $this->serviceOption->find($id);

        if (!$serviceOption) {
            return abort(404);
        }
        $this->execute(function () use ($request, $id) {
            $data = [
                'name' => $request->name,
                'type' => $request->type,
                'price' => $request->price,
                'description' => $request->description,
                'service_type_id' => $request->service_type_id,
            ];
            $this->serviceOption->where('id', $id)->update($data);
        });
        return redirect()->route('admin.service-option.index', ['service_id' => $serviceOption->service_id, 'service_season_id' => $serviceOption->service_season_id])->with('alert', config('ajax.messages.success.created'));
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
            $this->serviceOption->where('id', $id)->delete();
        });

        return MessageHelper::success(
            config('ajax.messages.success.deleted'),
            config('ajax.status.success.deleted')
        );
    }

    public function getOptionByServiceId($id, Request $request)
    {
        $service = $this->service->find($id);
        $time = Carbon::createFromFormat('Y-m-d', $request->time);
        $season = $service->seasons()->where('date_from', '<=', $time)
            ->where('date_to', '>=', $time)
            ->first();
        if (!$season) {
            return MessageHelper::success('Get option by service success', 200, []);
        }
        $services = $season->services()->get();
        return MessageHelper::success('Get option by service success', 200, $services);
    }
}
