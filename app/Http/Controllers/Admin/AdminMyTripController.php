<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\ServiceFullOption;
use App\Models\Tour;
use App\Models\MyTrip;
use App\Models\Booking;
use App\Models\Service;
use App\Models\TourDay;
use App\Models\ServiceFull;
use App\Models\ServiceType;
use App\Models\TourService;
use App\Models\ServiceOther;
use Illuminate\Http\Request;
use App\Helper\MessageHelper;
use App\Models\AdditionalFee;
use App\Models\SurchargeTrip;
use App\Models\TourDayOption;
use App\Models\IncludeServiceTrip;
use App\Traits\TransactionService;
use App\Http\Controllers\Controller;
use App\Models\PriceTypeServiceTrip;

class AdminMyTripController extends Controller
{
    use TransactionService;

    protected $booking;
    protected $serviceFull;
    protected $service;
    protected $serviceType;
    protected $additionalFee;
    protected $serviceOther;
    protected $myTrip;
    protected $tourService;
    protected $tour;
    protected $tourDay;
    protected $tourDayOption;
    protected $priceTypeServiceTrip;
    protected $surchargeTrip;
    protected $includeServiceTrip;

    protected $serviceFullOption;

    protected $surcharge;

    public function __construct(
        Booking              $booking,
        ServiceFull          $serviceFull,
        Service              $service,
        ServiceType          $serviceType,
        AdditionalFee        $additionalFee,
        ServiceOther         $serviceOther,
        MyTrip               $myTrip,
        Tour                 $tour,
        TourDay              $tourDay,
        TourService          $tourService,
        TourDayOption        $tourDayOption,
        PriceTypeServiceTrip $priceTypeServiceTrip,
        SurchargeTrip        $surchargeTrip,
        IncludeServiceTrip   $includeServiceTrip,
        ServiceFullOption    $serviceFullOption,
        AdditionalFee        $surcharge
    )
    {
        $this->includeServiceTrip = $includeServiceTrip;
        $this->surchargeTrip = $surchargeTrip;
        $this->priceTypeServiceTrip = $priceTypeServiceTrip;
        $this->tourDayOption = $tourDayOption;
        $this->tourService = $tourService;
        $this->tour = $tour;
        $this->tourDay = $tourDay;
        $this->booking = $booking;
        $this->service = $service;
        $this->serviceType = $serviceType;
        $this->serviceFull = $serviceFull;
        $this->additionalFee = $additionalFee;
        $this->serviceOther = $serviceOther;
        $this->myTrip = $myTrip;
        $this->serviceFullOption = $serviceFullOption;
        $this->surcharge = $surcharge;
    }

    public function index()
    {
        $myTrips = $this->myTrip->orderBy('id', 'desc')->paginate(15);
        return view('admin.pages.my-trip.index', compact('myTrips'));
    }

    public function create(Request $request)
    {
        $booking = $this->booking->find($request->booking_id);
        $serviceFullTour = $this->serviceFull->where('parent_id', 0)->get()->toArray();
        $serviceTour = $this->service->where('parent_id', 0)->get()->toArray();
        $serviceTypes = $this->serviceType->where('active', 1)->get();
        $serviceOther = $this->additionalFee->where('active', 1)->get();
        $serviceIncluded = $this->serviceOther->where('active', 1)->get();
        $listTour = $this->tour->with('tourDays')->get();
        $myTrips = $this->myTrip->orderBy('id', 'desc')->get();

        return view('admin.pages.my-trip.create', compact('myTrips','listTour','booking', 'serviceTour', 'serviceFullTour', 'serviceTypes', 'serviceOther', 'serviceIncluded'));
    }

    public function addTourPackage(Request $request)
    {
        if (count($request->listIds) > 0) {
            $day_start = $request->day_start + 1;
            $date_start = Carbon::parse($request->date_start);

            $listDateNext = [];

            for ($i = 0; $i < count($request->listIds); $i++) {
                if ($date_start->isToday() && $i == 0) {
                    $listDateNext[] =  $date_start->toDateString();
                } else {
                    $listDateNext[] =  $date_start->addDay()->toDateString();
                }
            }

            $randoms = [];
            for ($i = 0; $i < count($request->listIds); $i++) {
                $random = rand();
                while (in_array($random, $randoms)) {
                    $random = rand();
                }
                $randoms[] = $random;
            }

            $listDay = $this->tourDay->whereIn('id', $request->listIds)->get();
            $numberDay = count($request->listIds);

            $servicesOptions = $this->service->where('parent_id', 0)->get();

            $dayHtml = view('admin.components.my-trip.day', compact(
                'numberDay',
                'day_start',
                'listDateNext',
                'randoms'
            ))->render();
            $dayContentHtml = view('admin.components.my-trip.day-content', compact(
                'numberDay',
                'day_start',
                'listDateNext',
                'randoms',
                'randoms',
                'listDay',
                'servicesOptions',
                'request'
            ))->render();

            return response()->json([
                'status' => 'success',
                'dayHtml' => $dayHtml,
                'dayContentHtml' => $dayContentHtml,
                'dayLast' => $day_start + count($request->listIds) - 1,
                'date_Start' => current($listDateNext)
            ]);
        }
        return response()->json([
            'status' => 'success',
            'dayHtml' => '',
            'dayContentHtml' => '',
            'dayLast' => 0,
            'date_Start' => ''
        ]);
    }

    public function store(Request $request)
    {
//        dd($request->all());
        $this->execute(function () use ($request) {
            // MY TRIP
            $data = [
                'tour_name' => $request->tour_name,
                'tour_code' => $request->tour_code,
                'day_number' => $request->day_number,
                'date_start' => $request->date_start,
                'tour_class' => $request->tour_class,
                'title_name' => $request->title_name,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'market' => $request->market,
                'country' => $request->country,
                'adult_number' => $request->adult_number,
                'department' => $request->department,
                'phone' => $request->phone,
                'kid_number' => $request->kid_number,
                'group' => $request->group,
                'email' => $request->email,
                'delegation_list' => $request->delegation_list,
                'language' => $request->language,
                'tour_type' => $request->tour_type,
                'source' => $request->source,
                'execution_phase' => $request->execution_phase,
                'note' => $request->note,


                'overhead_costs' => $request->overhead_costs,
                'individual_costs' => $request->individual_costs,
                'tour_costs' => $request->tour_costs,
                'tour_costs_percent' => $request->tour_costs_percent,
                'tour_price' => $request->tour_price,
                'tour_price_per_person' => $request->tour_price_per_person,
                'surcharge' => $request->surcharge,
                'surcharge_per_person' => $request->surcharge_per_person,
                'final_cost' => $request->final_cost,
                'final_cost_per_person' => $request->final_cost_per_person,
            ];
            $myTrip = $this->myTrip->create($data);

            // TOUR FULL

            $dataTour = [
                'name' => $request->tour_name,
                'image_path' => $request->avatar_path,
                'trip_id' => $myTrip->id
            ];

            $tour = $this->tour->create($dataTour);

            if (isset($request->full_tour) && count($request->full_tour) > 0) {
                $dataTourService = [];
                foreach ($request->full_tour as $key => $value) {
                    $dataTourService[] = [
                        'tour_id' => $tour->id,
                        'parent_service_id' => $value,
                        'service_id' => isset($request->full_tour_child[$key]) ? $request->full_tour_child[$key] : 0,
                        'option_id' => isset($request->full_tour_option[$key]) ? $request->full_tour_option[$key] : 0
                    ];
                }
                $this->tourService->insert($dataTourService);
            }

            if (isset($request->day_order) && count($request->day_order) > 0) {
                foreach ($request->day_order as $key => $value) {
                    $tourDay = $this->tourDay->create([
                        'day_number' => $value,
                        'tour_id' => $tour->id,
                        'time' => isset($request->day_time[$key]) ? $request->day_time[$key] : null,
                        'name' => isset($request->day_title[$key]) ? $request->day_title[$key] : null,
                        'description' => isset($request->day_description[$key]) ? $request->day_description[$key] : null,
                        'image_path1' => isset($request->day_image_path1[$key]) ? $request->day_image_path1[$key] : null,
                        'image_path2' => isset($request->day_image_path2[$key]) ? $request->day_image_path2[$key] : null,
                    ]);

                    if (isset($request->day_service[$value])) {
                        $tourDays = [];
                        foreach ($request->day_service[$value] as $key2 => $value2) {
                            $tourDays[] = [
                                'tour_day_id' => $tourDay->id,
                                'parent_service_id' => $value2,
                                'service_id' => isset($request->day_service_child[$value][$key2]) ? $request->day_service_child[$value][$key2] : 0,
                                'option_id' => isset($request->day_service_option[$value][$key2]) ? $request->day_service_option[$value][$key2] : 0
                            ];
                        }
                        $this->tourDayOption->insert($tourDays);
                    }
                }
            }

            // PRICE TYPE SERVICE TRIP
            if (isset($request->service_type_id) && count($request->service_type_id) > 0) {
                $dataTypeServiceTrip = [];
                foreach ($request->service_type_id as $key => $value) {
                    $dataTypeServiceTrip[] = [
                        'trip_id' => $myTrip->id,
                        'type_service_id' => $value,
                        'percent' => isset($request->service_type_percent[$key]) ? $request->service_type_percent[$key] : 0,
                        'price' => isset($request->service_type_price[$key]) ? $request->service_type_price[$key] : 0,
                    ];
                }
                $this->priceTypeServiceTrip->insert($dataTypeServiceTrip);
            }

            // SURCHARGE
            if (isset($request->service_other_id) && count($request->service_other_id) > 0) {
                $dataSurcharge = [];
                foreach ($request->service_other_id as $key => $value) {
                    $dataSurcharge[] = [
                        'trip_id' => $myTrip->id,
                        'surcharge_id' => $value,
                        'price_per_one' => isset($request->price_other_one[$key]) ? $request->price_other_one[$key] : 0,
                        'price' => isset($request->price_other[$key]) ? $request->price_other[$key] : 0,
                    ];
                }
                $this->surchargeTrip->insert($dataSurcharge);
            }

            if (isset($request->included) && count($request->included) > 0) {
                $dataIncluded = [];
                foreach ($request->included as $key => $value) {
                    $dataIncluded[] = [
                        'trip_id' => $myTrip->id,
                        'service_id' => $value,
                        'type' => 1
                    ];
                }
                $this->includeServiceTrip->insert($dataIncluded);
            }

            if (isset($request->excluding) && count($request->excluding) > 0) {
                $dataExcluding = [];
                foreach ($request->excluding as $key => $value) {
                    $dataExcluding[] = [
                        'trip_id' => $myTrip->id,
                        'service_id' => $value,
                        'type' => 2
                    ];
                }
                $this->includeServiceTrip->insert($dataExcluding);
            }
        });
        return redirect()->route('admin.my-trip.index')->with('success', config('ajax.messages.success.created'));
    }

    public function edit($id)
    {
        $myTrip = $this->myTrip->with([
            'tour' => function ($query) {
                $query->with([
                    'tourDays' => function ($q) {
                        $q->with([
                            'tourDayOptions' => function ($q) {
                                $q->with(['service', 'option', 'parentService']);
                            }
                        ]);
                    },
                    'tourServices' => function ($q) {
                        $q->with(['option', 'parentService', 'tour', 'serviceFulls', 'serviceFullOptions']);
                    }
                ]);
            },
            'priceTypeServiceTrips' => function ($query) {
                $query->with(['serviceType']);
            },
            'includeServiceTrips' => function ($query) {
                $query->with(['service']);
            },
            'surchargeTrips' => function ($query) {
                $query->with(['surcharge']);
            }
        ])->find($id);


        $serviceFullTour = $this->serviceFull->where('parent_id', 0)->get();

        $serviceFullTourChilds = $this->serviceFull;

        $serviceFullTourOptions = $this->serviceFullOption;

        $serviceTour = $this->service->where('parent_id', 0)->get();

        $serviceOther = $this->additionalFee->where('active', 1)->get();

        $serviceIncluded = $this->serviceOther->where('active', 1)->get();

        $surcharges = $this->surcharge->where('active', 1)->get();

        return view('admin.pages.my-trip.edit', compact(
            'serviceFullTourOptions',
            'serviceFullTourChilds',
            'surcharges',
            'myTrip',
            'serviceFullTour',
            'serviceTour',
            'serviceOther',
            'serviceIncluded'
        ));
    }

    public function update(Request $request, $id)
    {
        $this->execute(function () use ($request, $id) {
            $myTrip = $this->myTrip->with([
                'tour' => function ($query) {
                    $query->with([
                        'tourDays' => function ($q) {
                            $q->with([
                                'tourDayOptions' => function ($q) {
                                    $q->with(['service', 'option', 'parentService']);
                                }
                            ]);
                        },
                        'tourServices' => function ($q) {
                            $q->with(['option', 'parentService', 'tour', 'serviceFulls', 'serviceFullOptions']);
                        }
                    ]);
                },
                'priceTypeServiceTrips' => function ($query) {
                    $query->with(['serviceType']);
                },
                'includeServiceTrips' => function ($query) {
                    $query->with(['service']);
                },
                'surchargeTrips' => function ($query) {
                    $query->with(['surcharge']);
                }
            ])->find($id);

            // Cập nhật thông tin MY TRIP
            $data = [
                'tour_name' => $request->tour_name,
                'tour_code' => $request->tour_code,
                'day_number' => $request->day_number,
                'date_start' => $request->date_start,
                'tour_class' => $request->tour_class,
                'title_name' => $request->title_name,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'market' => $request->market,
                'country' => $request->country,
                'adult_number' => $request->adult_number,
                'department' => $request->department,
                'phone' => $request->phone,
                'kid_number' => $request->kid_number,
                'group' => $request->group,
                'email' => $request->email,
                'delegation_list' => $request->delegation_list,
                'language' => $request->language,
                'tour_type' => $request->tour_type,
                'source' => $request->source,
                'execution_phase' => $request->execution_phase,
                'note' => $request->note,
                'overhead_costs' => $request->overhead_costs,
                'individual_costs' => $request->individual_costs,
                'tour_costs' => $request->tour_costs,
                'tour_costs_percent' => $request->tour_costs_percent,
                'tour_price' => $request->tour_price,
                'tour_price_per_person' => $request->tour_price_per_person,
                'surcharge' => $request->surcharge,
                'surcharge_per_person' => $request->surcharge_per_person,
                'final_cost' => $request->final_cost,
                'final_cost_per_person' => $request->final_cost_per_person,
            ];

            $myTrip->update($data);

            // Cập nhật TOUR FULL
            $tour = $this->tour->where('trip_id', $myTrip->id)->first();

            $dataTour = [
                'name' => $request->tour_name,
                'image_path' => !empty($request->avatar_path) ? $request->avatar_path : $myTrip->tour->image_path,
            ];

            $tour->update($dataTour);

            // Cập nhật TOUR SERVICES
            if (isset($request->full_tour)) {
                $this->tourService->where('tour_id', $tour->id)->delete();

                $dataTourService = [];

                foreach ($request->full_tour as $key => $value) {
                    $dataTourService[] = [
                        'tour_id' => $tour->id,
                        'parent_service_id' => $value,
                        'service_id' => isset($request->full_tour_child[$key]) ? $request->full_tour_child[$key] : 0,
                        'option_id' => isset($request->full_tour_option[$key]) ? $request->full_tour_option[$key] : 0
                    ];
                }
                $this->tourService->insert($dataTourService);
            }

            // Cập nhật TOUR DAYS
            if (isset($request->day_order)) {
                $this->tourDay->where('tour_id', $tour->id)->delete();
                foreach ($request->day_order as $key => $value) {
                    $tourDay = $this->tourDay->create([
                        'day_number' => $value,
                        'tour_id' => $tour->id,
                        'time' => isset($request->day_time[$key]) ? $request->day_time[$key] : null,
                        'name' => isset($request->day_title[$key]) ? $request->day_title[$key] : null,
                        'description' => isset($request->day_description[$key]) ? $request->day_description[$key] : null,
                        'image_path1' => isset($request->day_image_path1[$key]) ? $request->day_image_path1[$key] : null,
                        'image_path2' => isset($request->day_image_path2[$key]) ? $request->day_image_path2[$key] : null,
                    ]);

                    if (isset($request->day_service[$value])) {
                        $tourDays = [];
                        foreach ($request->day_service[$value] as $key2 => $value2) {
                            $tourDays[] = [
                                'tour_day_id' => $tourDay->id,
                                'parent_service_id' => $value2,
                                'service_id' => isset($request->day_service_child[$value][$key2]) ? $request->day_service_child[$value][$key2] : 0,
                                'option_id' => isset($request->day_service_option[$value][$key2]) ? $request->day_service_option[$value][$key2] : 0
                            ];
                        }
                        $this->tourDayOption->insert($tourDays);
                    }
                }
            }

            // Cập nhật SURCHARGES
            $this->surchargeTrip->where('trip_id', $myTrip->id)->delete();
            if (isset($request->service_other_id) && count($request->service_other_id) > 0) {
                $dataSurcharge = [];
                foreach ($request->service_other_id as $key => $value) {
                    $dataSurcharge[] = [
                        'trip_id' => $myTrip->id,
                        'surcharge_id' => $value,
                        'price_per_one' => isset($request->price_other_one[$key]) ? $request->price_other_one[$key] : 0,
                        'price' => isset($request->price_other[$key]) ? $request->price_other[$key] : 0,
                    ];
                }
                $this->surchargeTrip->insert($dataSurcharge);
            }

            // Cập nhật INCLUDE
            $this->includeServiceTrip->where('trip_id', $myTrip->id)->where('type', 1)->delete();
            if (isset($request->included) && count($request->included) > 0) {
                $dataIncluded = [];
                foreach ($request->included as $key => $value) {
                    $dataIncluded[] = [
                        'trip_id' => $myTrip->id,
                        'service_id' => $value,
                        'type' => 1
                    ];
                }
                $this->includeServiceTrip->insert($dataIncluded);
            }

            // Cập nhật EXCLUDE
            $this->includeServiceTrip->where('trip_id', $myTrip->id)->where('type', 2)->delete();
            if (isset($request->excluding) && count($request->excluding) > 0) {
                $dataExcluding = [];
                foreach ($request->excluding as $key => $value) {
                    $dataExcluding[] = [
                        'trip_id' => $myTrip->id,
                        'service_id' => $value,
                        'type' => 2
                    ];
                }
                $this->includeServiceTrip->insert($dataExcluding);
            }
        });

        return redirect()->route('admin.my-trip.index')->with('success', config('ajax.messages.success.updated'));
    }

    public function copy($id)
    {
        $myTrip = $this->myTrip->with([
            'tour' => function ($query) {
                $query->with([
                    'tourDays' => function ($q) {
                        $q->with([
                            'tourDayOptions' => function ($q) {
                                $q->with(['service', 'option', 'parentService']);
                            }
                        ]);
                    },
                    'tourServices' => function ($q) {
                        $q->with(['option', 'parentService', 'tour', 'serviceFulls', 'serviceFullOptions']);
                    }
                ]);
            },
            'priceTypeServiceTrips' => function ($query) {
                $query->with(['serviceType']);
            },
            'includeServiceTrips' => function ($query) {
                $query->with(['service']);
            },
            'surchargeTrips' => function ($query) {
                $query->with(['surcharge']);
            }
        ])->find($id);

        $serviceFullTour = $this->serviceFull->where('parent_id', 0)->get();

        $serviceFullTourChilds = $this->serviceFull;

        $serviceFullTourOptions = $this->serviceFullOption;

        $serviceTour = $this->service->where('parent_id', 0)->get();

        $serviceTypes = $this->serviceType->where('active', 1)->get();

        $serviceOther = $this->additionalFee->where('active', 1)->get();

        $serviceIncluded = $this->serviceOther->where('active', 1)->get();

        $surcharges = $this->surcharge->where('active', 1)->get();

        return view('admin.pages.my-trip.copy', compact(
            'serviceFullTourOptions',
            'serviceFullTourChilds',
            'surcharges',
            'myTrip',
            'serviceFullTour',
            'serviceTour',
            'serviceTypes',
            'serviceOther',
            'serviceIncluded'
        ));
    }

    public function storeCopy(Request $request)
    {
        // Tạo bản sao logic tương tự như store
        $this->execute(function () use ($request) {
            $data = [
                'tour_name' => $request->tour_name,
                'tour_code' => $request->tour_code,
                'day_number' => $request->day_number,
                'date_start' => $request->date_start,
                'tour_class' => $request->tour_class,
                'title_name' => $request->title_name,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'market' => $request->market,
                'country' => $request->country,
                'adult_number' => $request->adult_number,
                'department' => $request->department,
                'phone' => $request->phone,
                'kid_number' => $request->kid_number,
                'group' => $request->group,
                'email' => $request->email,
                'delegation_list' => $request->delegation_list,
                'language' => $request->language,
                'tour_type' => $request->tour_type,
                'source' => $request->source,
                'execution_phase' => $request->execution_phase,
                'note' => $request->note,
                'overhead_costs' => $request->overhead_costs,
                'individual_costs' => $request->individual_costs,
                'tour_costs' => $request->tour_costs,
                'tour_costs_percent' => $request->tour_costs_percent,
                'tour_price' => $request->tour_price,
                'tour_price_per_person' => $request->tour_price_per_person,
                'surcharge' => $request->surcharge,
                'surcharge_per_person' => $request->surcharge_per_person,
                'final_cost' => $request->final_cost,
                'final_cost_per_person' => $request->final_cost_per_person,
            ];

            $myTrip = $this->myTrip->create($data);

            // TOUR FULL
            $dataTour = [
                'name' => $request->tour_name,
                'image_path' => $request->avatar_path,
                'trip_id' => $myTrip->id
            ];

            $tour = $this->tour->create($dataTour);

            if (isset($request->full_tour) && count($request->full_tour) > 0) {
                $dataTourService = [];
                foreach ($request->full_tour as $key => $value) {
                    $dataTourService[] = [
                        'tour_id' => $tour->id,
                        'parent_service_id' => $value,
                        'service_id' => isset($request->full_tour_child[$key]) ? $request->full_tour_child[$key] : 0,
                        'option_id' => isset($request->full_tour_option[$key]) ? $request->full_tour_option[$key] : 0
                    ];
                }
                $this->tourService->insert($dataTourService);
            }

            // TOUR DAY COPY
            if (isset($request->day_order) && count($request->day_order) > 0) {
                foreach ($request->day_order as $key => $value) {
                    $tourDay = $this->tourDay->create([
                        'day_number' => $value,
                        'tour_id' => $tour->id,
                        'time' => isset($request->day_time[$key]) ? $request->day_time[$key] : null,
                        'name' => isset($request->day_title[$key]) ? $request->day_title[$key] : null,
                        'description' => isset($request->day_description[$key]) ? $request->day_description[$key] : null,
                        'image_path1' => isset($request->day_image_path1[$key]) ? $request->day_image_path1[$key] : null,
                        'image_path2' => isset($request->day_image_path2[$key]) ? $request->day_image_path2[$key] : null,
                    ]);

                    if (isset($request->day_service[$value])) {
                        $tourDays = [];
                        foreach ($request->day_service[$value] as $key2 => $value2) {
                            $tourDays[] = [
                                'tour_day_id' => $tourDay->id,
                                'parent_service_id' => $value2,
                                'service_id' => isset($request->day_service_child[$value][$key2]) ? $request->day_service_child[$value][$key2] : 0,
                                'option_id' => isset($request->day_service_option[$value][$key2]) ? $request->day_service_option[$value][$key2] : 0
                            ];
                        }
                        $this->tourDayOption->insert($tourDays);
                    }
                }
            }

            // PRICE TYPE SERVICE TRIP COPY
            if (isset($request->service_type_id) && count($request->service_type_id) > 0) {
                $dataTypeServiceTrip = [];
                foreach ($request->service_type_id as $key => $value) {
                    $dataTypeServiceTrip[] = [
                        'trip_id' => $myTrip->id,
                        'type_service_id' => $value,
                        'percent' => isset($request->service_type_percent[$key]) ? $request->service_type_percent[$key] : 0,
                        'price' => isset($request->service_type_price[$key]) ? $request->service_type_price[$key] : 0,
                    ];
                }

                $this->priceTypeServiceTrip->insert($dataTypeServiceTrip);
            }

            // SURCHARGE COPY
            if (isset($request->service_other_id) && count($request->service_other_id) > 0) {
                $dataSurcharge = [];
                foreach ($request->service_other_id as $key => $value) {
                    $dataSurcharge[] = [
                        'trip_id' => $myTrip->id,
                        'surcharge_id' => $value,
                        'price_per_one' => isset($request->price_other_one[$key]) ? $request->price_other_one[$key] : 0,
                        'price' => isset($request->price_other[$key]) ? $request->price_other[$key] : 0,
                    ];
                }
                $this->surchargeTrip->insert($dataSurcharge);
            }

            // INCLUDED COPY
            if (isset($request->included) && count($request->included) > 0) {
                $dataIncluded = [];
                foreach ($request->included as $key => $value) {
                    $dataIncluded[] = [
                        'trip_id' => $myTrip->id,
                        'service_id' => $value,
                        'type' => 1
                    ];
                }
                $this->includeServiceTrip->insert($dataIncluded);
            }

            // EXCLUDING COPY
            if (isset($request->excluding) && count($request->excluding) > 0) {
                $dataExcluding = [];
                foreach ($request->excluding as $key => $value) {
                    $dataExcluding[] = [
                        'trip_id' => $myTrip->id,
                        'service_id' => $value,
                        'type' => 2
                    ];
                }
                $this->includeServiceTrip->insert($dataExcluding);
            }
        });
        return redirect()->route('admin.my-trip.index')->with('success', config('ajax.messages.success.created'));
    }


    public function destroy($id)
    {
        $myTrip = $this->myTrip->find($id);
        $myTrip->delete();
        return MessageHelper::success(
            config('ajax.messages.success.deleted'),
            config('ajax.status.success.deleted')
        );
    }
}
