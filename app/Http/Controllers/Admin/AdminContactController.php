<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Booking;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Traits\DeleteRecordTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminContactController extends Controller
{
    use DeleteRecordTrait;
    private  $contact;
    private $listStatus;
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
        $this->listStatus = $this->contact->listStatus;
    }
    public function index(Request $request)
    {
        $contacts = $this->contact;

        //   $a=  \DB::table('contacts')
        //     ->select('status', \DB::raw('count(*) as total'))
        //     ->groupBy('status')->get();
        //     dd($a);

        // $collection =  $this->contact->groupBy('status')
        // ->selectRaw('count(*) as total, status')
        // ->get();
        // dd($collection);

        $contactGroupByStatus = $this->contact->where('status', '<>', -1)->select($this->contact->where('status', '<>', -1)->raw('count(status) as total'), 'status')->groupBy('status')->get();
        $totalContact = $this->contact->all()->count();

        $dataContactGroupByStatus = $this->listStatus;
        foreach ($contactGroupByStatus as $item) {
            $dataContactGroupByStatus[$item->status]['total'] = $item->total;
        }



        $where = [];
        if ($request->has('keyword') && $request->input('keyword')) {
            $where[] = ['name', 'like', '%' . $request->input('keyword') . '%'];
        }
        if ($request->has('status') && $request->input('status')) {
            $where[] = ['status', $request->input('status')];
        }
        if ($where) {
            $contacts = $contacts->where($where);
        }
        $orderby = [];
        if ($request->has('order_with') && $request->input('order_with')) {
            $key = $request->input('order_with');
            switch ($key) {
                case 'dateASC':
                    $orderby[] = ['created_at'];
                    break;
                case 'dateDESC':
                    $orderby[] = [
                        'created_at',
                        'DESC'
                    ];
                    break;
                case 'statusASC':
                    $orderby[] = ['status', 'ASC'];
                    $orderby[] = ['created_at', 'DESC'];
                    break;
                case 'statusDESC':
                    $orderby[] = ['status', 'DESC'];
                    $orderby[] = [
                        'created_at',
                        'DESC'
                    ];
                    break;
                default:
                    $orderby[] = [
                        'created_at',
                        'DESC'
                    ];
                    break;
            }
            foreach ($orderby as $or) {
                $contacts = $contacts->orderBy(...$or);
            }
        } else {
            $contacts = $contacts->orderBy("created_at", "DESC");
        }
        $contacts =  $contacts->paginate(15);
        return view('admin.pages.contact.index', [
            'dataContactGroupByStatus' => $dataContactGroupByStatus,
            'totalContact' => $totalContact,
            'data' => $contacts,
            'listStatus' => $this->listStatus,
            'keyword' => $request->input('keyword') ? $request->input('keyword') : "",
            'order_with' => $request->input('order_with') ? $request->input('order_with') : "",
            'statusCurrent' => $request->input('status') ? $request->input('status') : "",
        ]);
    }
    public function booking(Request $request)
    {
        $bookings = new Booking();
        if ($request->has('keyword') && !empty($request->input('keyword'))) {
            $keyword = trim($request->input('keyword'));
            $bookings =  $bookings->where('name', 'like', '%' . $keyword . '%')
                ->orWhere('price', 'like', '%' . $keyword . '%')
                ->orWhere('phone', 'like', '%' . $keyword . '%')
                ->orWhere('email', 'like', '%' . $keyword . '%')
                ->orWhere('code', 'like', '%' . $keyword . '%')
                ->orWhere(DB::raw("CONCAT(customer_title, ' ', customer_first_name, ' ', customer_last_name)"), 'like', '%' . $keyword . '%');
        }
        if ($request->has('status') && !empty($request->input('status'))) {
            $status = $request->input('status');
            $bookings = $bookings->where('status', $status);
        }
        if ($request->has('start_date') || $request->has('end_date')) {
            $date = [];
            if (!empty($request->input('start_date'))) {
                $date[] = ['date_to', '>=', $request->input('start_date')];
            }
            if (!empty($request->input('end_date'))) {
                $date[] = ['date_to', '<=', $request->input('end_date')];
            }
            $bookings = $bookings->where($date);
        }
        $bookings = $bookings->paginate(15);
        $totalPrice = Booking::sum('price');
        $totalBooking = Booking::count();
        $totalBookingSuccess = Booking::where('status', 2)->count();
        $totalBookingNew = Booking::where('status', 1)->count();
        $sales = Admin::all();
        return view('admin.pages.contact.booking', compact('bookings', 'totalPrice', 'totalBooking', 'totalBookingSuccess', 'totalBookingNew', 'sales'));
    }

    public function changeStatus($id, Request $request)
    {
        $booking = Booking::find($id);
        $booking->update([
            'status' => $request->status
        ]);
        return response()->json([
            'code' => 200,
            'messange' => 'success'
        ], 200);
    }

    public function changeSale($id, Request $request)
    {
        $booking = Booking::find($id);
        $booking->update([
            'admin_id' => $request->sale
        ]);
        return response()->json([
            'code' => 200,
            'messange' => 'success'
        ], 200);
    }

    public function loadNextStepStatus(Request $request)
    {
        $id = $request->id;
        $contact = $this->contact->find($id);
        $status = $contact->status;
        switch ($status) {
            case -1:
                break;
            case 1:
                $status += 1;
                break;
            case 2:
                break;
            default:
                break;
        }
        $contact->update([
            'status' => $status,
        ]);
        return response()->json([
            'code' => 200,
            'htmlStatus' => view('admin.components.status', [
                'dataStatus' => $contact,
                'listStatus' => $this->listStatus,
            ])->render(),
            'messange' => 'success'
        ], 200);
    }
    public function loadContactDetail($id)
    {

        $contact = $this->contact->find([$id]);

        return response()->json([
            'code' => 200,
            'htmlTransactionDetail' => view('admin.components.contact-detail', [
                'data' => $contact,
                'listStatus' => $this->listStatus,
            ])->render(),
            'messange' => 'success'
        ], 200);
    }

    public function destroy($id)
    {
        return $this->deleteTrait($this->contact, $id);
    }

    public function show($id)
    {
        $contacts = $this->contact->find($id);
        return view('admin.pages.transaction.show', [
            'data' => $contacts,
        ]);
    }
}
