<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Booking;
use App\Models\Contact;
use App\Models\Setting;
use App\Mail\ContactEmail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;


use Illuminate\Support\Carbon;
use App\Models\CategoryProduct;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    //
    private $setting;
    private $contact;
    public function __construct(Setting $setting, Contact $contact)
    {
        /*$this->middleware('auth');*/
        $this->setting = $setting;
        $this->contact = $contact;
    }
    public function index()
    {
        $resultCheckLang = checkRouteLanguage2();
        if ($resultCheckLang) {
            return $resultCheckLang;
        }

        $breadcrumbs = [
            [
                'name' => __('home.lien_he'),
                'slug' => makeLinkToLanguage('contact', null, null, \App::getLocale()),
            ],
        ];

        $dataAddress = $this->setting->where('active', 1)->find(408);
        $map = $this->setting->where('active', 1)->find(409);
        $travelExperts = $this->setting->where('active', 1)->find(581);
        $ourTour = CategoryProduct::find(411);
        $travelStyle = CategoryProduct::find(446);
        $listOurTeam = Post::where('active', 1)->where('category_id', 107)->orderByDesc('id')->limit('6')->get();
        $whyBook = $this->setting->where('active', 1)->find(582);

        return view("frontend.pages.contact", [

            'breadcrumbs' => $breadcrumbs,
            'typeBreadcrumb' => 'contact',
            'title' =>  "Help me plan my trip",

            "dataAddress" => $dataAddress,
            "map" => $map,
            "travelExperts" => $travelExperts,
            "ourTour" => $ourTour,
            "travelStyle" => $travelStyle,
            "listOurTeam" => $listOurTeam,
            "whyBook" => $whyBook,

            'seo' => [
                'title' => "Help me plan my trip",
                'keywords' =>  "Help me plan my trip",
                'description' =>   "Help me plan my trip",
                'image' =>  "",
                'abstract' =>  "Help me plan my trip",
            ],
        ]);
    }

    public function storeAjax(Request $request)
    {
        try {
            DB::beginTransaction();
            $noidung = '';
            $title = 'THÔNG TIN LIÊN HỆ';
            if ($request->input('content')) {
                $noidung = ($request->input('title') ?? $title) . '<br />' . 'Nội dung: ' . $request->input('content');
            } else {
                $noidung = ($request->input('title') ?? $title);
            }

            $dataContactCreate = [
                'name' => $request->input('name') ?? "",
                'phone' => $request->input('phone') ?? "",
                'email' => $request->input('email') ?? "",
                'active' => $request->input('active') ?? 1,
                'status' => 1,
                'city_id' => $request->input('city_id') ?? null,
                'district_id' => $request->input('district_id') ?? null,
                'commune_id' => $request->input('commune_id') ?? null,
                'address_detail' => $request->input('address_detail') ?? null,
                'content' => $noidung,
                'admin_id' => 0,
                'user_id' => Auth::check() ? Auth::user()->id : 0,
            ];

            $contact = $this->contact->create($dataContactCreate);
            // $mail = $this->setting->where('active', 1)->find(456);
            // if ($mail && $mail->value != null) {
            //     Mail::to($mail->value)->send(new ContactEmail($contact));
            // }

            DB::commit();
            return response()->json([
                "code" => 200,
                "html" => 'Information sent successfully',
                "message" => "success"
            ], 200);
        } catch (\Exception $exception) {
            //throw $th;
            DB::rollBack();
            Log::error('message' . $exception->getMessage() . 'line :' . $exception->getLine());
            return response()->json([
                "code" => 500,
                'html' => 'Sending information failed',
                "message" => "fail"
            ], 500);
        }
    }

    public function planTrip(Request $request)
    {
        try {
            DB::beginTransaction();

            $data = [
                'name' => $request->input('name') ?? "",
                'code' => $this->generateCode($request->input('first_name')),
                'status' => 1,
                'admin_id' => null,
                'date_to' => Carbon::createFromFormat('Y-m-d', $request->input('date'))->format('Y-m-d H:i:s'),
                'price' => $request->input('price'),
                'country' => $request->input('address_detail') ?? '',
                'email' => $request->input('email') ?? '',
                'phone' => $request->input('phone') ?? '',
                'customer_title' => $request->input('title') ?? '',
                'customer_first_name' => $request->input('first_name') ?? '',
                'customer_last_name' => $request->input('last_name') ?? '',
                'description' => $request->input('specific_requests') ?? '',
                'amount_customer' => $request->input('adult') ?? '',
                'budget_person' => $request->input('budget_person'),
                'plantrip' => $request->input('plantrip') ?? '',
            ];

            $contact = Booking::create($data);
            // dd($data);
            // $noidung = '';
            // $title = 'PLAN TRIP';
            // $planTripInfo = $request->input('plantrip');
            // if ($planTripInfo) {
            //     $noidung = ($request->input('title') ?? $title) . '<br />' . $planTripInfo;
            // } else {
            //     $noidung = ($request->input('title') ?? $title);
            // }

            // $dataContactCreate = [
            //     // 'name' => $request->input('name') ?? "",
            //     'name' => $request->input('first_name') . ' ' . $request->input('last_name') ?? "",
            //     'phone' => $request->input('phone') ?? "",
            //     'email' => $request->input('email') ?? "",
            //     'active' => $request->input('active') ?? 1,
            //     'status' => 1,
            //     'city_id' => $request->input('city_id') ?? null,
            //     'district_id' => $request->input('district_id') ?? null,
            //     'commune_id' => $request->input('commune_id') ?? null,
            //     'address_detail' => $request->input('address_detail') ?? null,
            //     'content' => $noidung,
            //     'admin_id' => 0,
            //     'user_id' => Auth::check() ? Auth::user()->id : 0,
            // ];

            // $contact = $this->contact->create($dataContactCreate);

            $mail = $this->setting->where('active', 1)->find(456);
            // if ($mail && $mail->value != null) {
            //     Mail::to($mail->value)->send(new ContactEmail($contact));
            // }

            DB::commit();

            return redirect()->route('thankYou');
        } catch (\Exception $exception) {
            //throw $th;
            DB::rollBack();
            Log::error('message' . $exception->getMessage() . 'line :' . $exception->getLine());
            return response()->json([
                "code" => 500,
                'html' => 'Sending information failed',
                "message" => "fail"
            ], 500);
        }
    }

    public function generateCode($name = '')
    {

        $code = strtoupper(Str::random(3));
        return 'S20724' . $code . '-' . $name;
    }

    public function thankYou()
    {
        $data = $this->setting->where('active', 1)->find(500);

        return view("frontend.pages.thank-you", [
            "data" => $data,
            'seo' => [
                'title'         => "Thank You",
                'keywords'      => "Thank You",
                'description'   => "Thank You",
                'image'         =>  "",
                'abstract'      => "Thank You",
            ],
        ]);
    }

    public function getExpert($id)
    {
        $expert = Post::find($id);
        if (!$expert) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $html = view('frontend.pages.load-detail-expert', compact('expert'))->render();

        return response()->json(['html' => $html]);
    }
}
