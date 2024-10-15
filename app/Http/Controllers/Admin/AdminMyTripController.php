<?php

namespace App\Http\Controllers\Admin;

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

    public function __construct(
        Booking $booking,
        ServiceFull $serviceFull,
        Service $service,
        ServiceType $serviceType,
        AdditionalFee $additionalFee,
        ServiceOther $serviceOther,
        MyTrip $myTrip,
        Tour $tour,
        TourDay $tourDay,
        TourService $tourService,
        TourDayOption $tourDayOption,
        PriceTypeServiceTrip $priceTypeServiceTrip,
        SurchargeTrip $surchargeTrip,
        IncludeServiceTrip $includeServiceTrip
    ) {
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

        return view('admin.pages.my-trip.create', compact('booking', 'serviceTour', 'serviceFullTour', 'serviceTypes', 'serviceOther', 'serviceIncluded'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
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
        $myTrip = $this->myTrip->find($id);
        $serviceFullTour = $this->serviceFull->where('parent_id', 0)->get()->toArray();
        $serviceTour = $this->service->where('parent_id', 0)->get()->toArray();
        $serviceTypes = $this->serviceType->where('active', 1)->get();
        $serviceOther = $this->additionalFee->where('active', 1)->get();
        $serviceIncluded = $this->serviceOther->where('active', 1)->get();
        dd($myTrip->tour);
        return view('admin.pages.my-trip.edit', compact('myTrip', 'serviceFullTour', 'serviceTour', 'serviceTypes', 'serviceOther', 'serviceIncluded'));
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
