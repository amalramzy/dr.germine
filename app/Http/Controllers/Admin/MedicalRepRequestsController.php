<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slot;
use Illuminate\Http\Request;
use App\Models\Represervation;
use Illuminate\Support\Carbon;
use App\Models\MedicalRepRequests;
use App\Http\Controllers\Controller;
use App\Http\Requests\RejectRequest;
use App\Http\Requests\ApproveRequest;
use Yajra\DataTables\Facades\DataTables;

class MedicalRepRequestsController extends Controller
{

    public function index(Request $request)
    {
        $dueDate = Carbon::now()->addDays(3);
        $nowDate = Carbon::now();
        $slots = Slot::whereDate('date', '>=', $nowDate)
            ->whereDate('date', '<=', $dueDate)->get();

        if ($request->ajax()) {
            $data = MedicalRepRequests::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('medical_rep_name', function ($row) {
                    $name = $row->medicalRep->name;
                    $userShow = '<a href="' . route('sale-persons.show', [$row->id]) . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="show showUser">' . $name . '</a>';
                    return $userShow;
                })
                // ->addColumn('slot', function ($row) {
                //     $special_datetime = $row->slot->date;
                //     $formatDate = Carbon::parse($special_datetime)->translatedFormat('d-m-Y');
                //     return $formatDate;
                // })
                ->addColumn('slot', function ($row) {
                    $special_datetime = $row->special_datetime;
                    $formatDate = Carbon::parse($special_datetime)->translatedFormat('d-m-Y');
                    return $formatDate;
                })
                ->addColumn('comment', function ($row) {
                    $comment = $row->comment;
                    return $comment;
                })
                ->addColumn('last_visit', function ($row) {
                    $special_datetime = $row->special_datetime;
                    $formatDate = Carbon::parse($special_datetime)->translatedFormat('d-m-Y');
                    return $formatDate;
                })
                ->addColumn('rejection_reason', function ($row) {
                    $rejection_reason = $row->rejection_reason;
                    return $rejection_reason;
                })
                ->addColumn('approve', function ($row) {
                    if($row->status == 'rejected'){
                        return "";
                    }else{
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id=' . $row->id . ' data-original-title="Approve" class="edit approveRquest"><i class="mdi mdi-check"></i></a>';
                        return $btn;
                    }

                })
                ->addColumn('reject', function ($row) {
                    if($row->status == 'rejected'){
                        return "";
                    }else{
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id=' . $row->id . ' data-original-title="Reject" class="delete rejectRquest"><i class="bi bi-dash-circle-fill"></i></a>';
                    return $btn;
                    }

                })
                ->rawColumns(['medical_rep_name', 'approve', 'reject'])
                ->make(true);
        }

        return view('admin.medical-rep-requests.index', compact('slots'));
    }

    public function approve(Request $request)
    {
        $medicalRepRequests = MedicalRepRequests::find($request->medical_req_id);
        $medicalRepRequests->status = "approved";
        $medicalRepRequests->update();
        $slot_order = 0;
        if ($request->has('slot_id') && $request->slot_id != "00") {
            $slot = Slot::find($request->slot_id);
            if ($slot && !$slot->is_full) {
                $slot_order = $slot->reserved + 1;
                $slot->reserved = $slot_order;
                $slot->save();
            } else {
                return response()->json(['message' => 'invalid slot'], 400);
            }
        }

        $reservation = Represervation::updateOrCreate(
            [
                'salePerson_id' => $medicalRepRequests->medical_rep_id,
                'slot_id' => $request->slot_id == "00" ? null : $request->slot_id,
                'slot_order'=>$slot_order,
                'special_datetime'=>$request->date,
                // 'comment' =>,
                // 'status' => $medicalRepRequests->status,
            ]
        );

        if ($reservation->slot_id) {
            $slottable = Slot::where('id', '=', $reservation->slot_id)->first();

            $fullDate =  Carbon::parse($slottable->date)->translatedFormat('Y-m-d');

            $fullTime = Carbon::parse($slottable->from)->translatedFormat('H:i:s');

            $reservation->special_datetime = $fullDate . ' ' . $fullTime;
            $reservation->save();
        }

        $medicalRepRequests->delete();
        return response()->json(['success' => 'Request Approved Successfully']);
    }

    public function reject(RejectRequest $request)
    {
        $data = MedicalRepRequests::find($request->medical_rep_req_id);
        $data->rejection_reason = $request->rejection_reason;
        $data->status = "rejected";
        $data->update();
        return response()->json(['success' => 'Request Rejected Successfully']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $repRequest= MedicalRepRequests::create(
            [
                'medical_rep_id' => $request->salePerson_id,
                'comment' => $request->comment,
                'slot_id'=>$request->slot_id == "00" ? null : $request->slot_id,
                'special_datetime'=>$request->date,
            ]
        );

        if($request->slot_id != '00'){
            $slottable = Slot::where('id','=', $repRequest->slot_id)->first();
            $fullDate =  Carbon::parse($slottable->date)->translatedFormat('Y-m-d');
            $fullTime = Carbon::parse($slottable->from)->translatedFormat('H:i:s');
            $repRequest->special_datetime = $fullDate.' '.$fullTime;
            $repRequest->save();
        }
        return response()->json(['success'=>'Rep Request Created successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
