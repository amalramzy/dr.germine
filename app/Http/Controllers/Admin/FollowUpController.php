<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slot;
use App\Models\User;
use App\Models\Child;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\AvailableFollowUp;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;
use Yajra\DataTables\Facades\DataTables;

class FollowUpController extends Controller
{
    public function availableFollowUp(Request $request)
    {
        $dueDate = Carbon::now()->addDays(3);
        $nowDate = Carbon::now();
        $slots = Slot::whereDate('date', '>=', $nowDate)
            ->whereDate('date', '<=', $dueDate)->get();

        if ($request->ajax()) {
            $data = AvailableFollowUp::latest()->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="delete deleteFollowUp"><i class="mdi mdi-delete"></i></a>';
                    return $btn;
                })
                ->addColumn('available_for', function ($row) {
                    return $row->available_for;
                })
                ->addColumn('phone', function ($row) {
                    $user = User::find($row->child->user_id);
                    return $user->phone1;
                })
                ->addColumn('mother', function ($row) {
                    $user = User::find($row->child->user_id);
                    return $user->mother;
                })
                ->addColumn('father', function ($row) {
                    $user = User::find($row->child->user_id);
                    $userShow = '<a href="' . route('users.show', [$user->id]) . '" data-toggle="tooltip"  data-id="' . $user->id . '" data-original-title="Delete" class="show showUser">' . $user->father . '</a> <br>';
                    return $userShow;
                })
                ->addColumn('child', function ($row) {
                    $userShow = '<a href="' . route('children.show', [$row->child->id]) . '" data-toggle="tooltip"  data-id="' . $row->child->id . '" data-original-title="Delete" class="show showUser">' . $row->child->name . '</a> <br>';
                    return $userShow;
                })
                ->addColumn('reservation_date', function ($row) {
                    $formatDate = Carbon::parse($row->reservation->special_datetime)->translatedFormat('d-m-Y');
                    return $formatDate;
                })
                ->addColumn('available_to', function ($row) {
                    $formatDate = Carbon::parse($row->available_to)->translatedFormat('d-m-Y');
                    $btn = $formatDate . '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit editAvailableDate"><i class="mdi mdi-square-edit-outline"></i></a>';
                    return $btn;
                })
                ->addColumn('follow_up_reservation', function ($row) {
                    $btn = ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="create" class="edit createFollowUp"><i class="mdi mdi-check"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action', 'father', 'child', 'available_to', 'follow_up_reservation'])
                ->make(true);
        }
        return view('admin.follow-ups.available', compact('slots'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $availableFollowUps = AvailableFollowUp::updateOrCreate(
            [
                'id' => $request->follow_up_id
            ],
            [
                'available_to' => $request->available_to,
            ]
        );
        if ($request->available_to) {
            $availableFollowUps->available_to = $request->available_to;
            $availableFollowUps->save();
        }
        return response()->json(['success' => 'Follow Up Updated successfully.']);
    }

    public function edit($id)
    {
        $availableFollowUps = AvailableFollowUp::find($id);
        return response()->json($availableFollowUps);
    }

    public function destroy($id)
    {
        availableFollowUp::find($id)->delete();

        return response()->json(['success' => 'Follow Up deleted successfully.']);
    }
}
