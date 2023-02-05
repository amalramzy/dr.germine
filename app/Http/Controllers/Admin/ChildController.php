<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChildRequest;
use App\Models\Child;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Slot;
use App\Models\Reservation;
use Illuminate\Support\Carbon;
use App\Models\Setting;

class ChildController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            if ($request->has('gender')) {
                if($request->gender == 'male' || $request->gender == 'femail'){
                    $data = Child::where('gender', $request->gender)->latest()->get();
                }else{
                    $data = Child::latest()->get();
                }
            } else {
                $data = Child::latest()->get();
            }

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit editChild"><i class="mdi mdi-square-edit-outline"></i></a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="delete deleteChild"><i class="mdi mdi-delete"></i></a>';
                    //    $btn = $btn.' <a href="'.route('children.show',[$row->id]).'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="show showUser"><i class="mdi mdi-eye-outline"></i></a>';

                    return $btn;
                })
                ->addColumn('name', function ($row) {
                    $name = $row->name;
                    $childShow = '<a href="' . route('children.show', [$row->id]) . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="show showUser">' . $name . '</a>';
                    return $childShow;
                })
                ->addColumn('father', function ($row) {
                    $name = $row->user->father;
                    return $name;
                })
                ->addColumn('mother', function ($row) {
                    $name = $row->user->mother;
                    return $name;
                })
                ->addColumn('phone', function ($row) {
                    $name = $row->user->phone1;
                    return $name;
                })
                ->addColumn('birthdate', function ($row) {
                    // $birthdate = $row->birthdate;

                    $formatDate = Carbon::parse($row->birthdate)->translatedFormat('d-m-Y');
                    return $formatDate;
                })
                ->addColumn('last_reservation_time', function ($row) {
                    $formatDate = Carbon::parse($row->last_reservation_time)->translatedFormat('d-m-Y');
                    return $row->last_reservation_time ? $formatDate : null;
                })
                ->addColumn('image', function ($row) {
                    if ($row->image != null) {
                        $image = '<img src="' . $row->image . '" class="img-thumbnail">';
                    } else {
                        $image = '<img src="../assets/images/users/user-def.png" class="img-thumbnail">';
                    }
                    return $image;
                })
                ->rawColumns(['action', 'name', 'image'])
                ->make(true);
        }
        if ($request->gender) {
            $gender = $request->gender;
            return view('admin.child.index', compact('gender'));
        }

        return view('admin.child.index');
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
    public function store(ChildRequest $request)
    {
        $child = Child::updateOrCreate(
            [
                'id' => $request->child_id
            ],
            [
                'name' => $request->name,
                'birthdate' => $request->birthdate,
                'gender' => $request->gender,
                'hospital' => $request->hospital,
                'user_id' => $request->user_id
            ]
        );
        if ($child) {
            if ($request->hasFile('image')) {
                $child->clearMediaCollection('image');
                $child->addMedia($request->file('image'))->toMediaCollection('image');
            }
        } else {
            if ($request->file('image')) {
                $child->addMedia($request->file('image'))->toMediaCollection('image');
            }
        }


        return response()->json(['success' => 'Child Updated successfully.']);
    }


    public function show($id)
    {

        $child = Child::find($id);
        // $url = $child->child_tests;
        //    $media = $child->getFirstMedia('child_tests');
        $media =  $child->getFirstMedia('child_tests');
        //  dd($media);
        // $childBirthdate =$child->birthdate;
        $today = Carbon::today();


        $birthDate = Carbon::createFromFormat('Y-m-d', $child->birthdate);
        $calc = date_diff(date_create($child->birthdate), date_create($today));
        $childDays = $calc->format('%a');
        $day  = $child->age->d;
        $month  = $child->age->m;
        $year  = $child->age->y;
        $dueDate = Carbon::now()->addDays(3);
        $nowDate = Carbon::now();
        $slots = Slot::whereDate('date', '>=', $nowDate)
            ->whereDate('date', '<=', $dueDate)->get();
        $settingFollowUp = Setting::where('key', 'follow_up_days')->first();
        $reservations = $child->reservations;
        // $reservationAll =  Reservation::where('child_id', $child->id)->get();
        // $reservationDays = $reservation->special_datetime;
        // $reservationFollowUp = Reservation::where('child_id', $child->id)
        //                                     ->where('is_follow_up','1')->get();
        return view('admin.child.show', compact(['year', 'month', 'day', 'child', 'childDays', 'slots', 'media', 'settingFollowUp', 'reservations']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $child = Child::find($id);
        return response()->json($child);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Child::find($id)->delete();

        return response()->json(['success' => 'Child deleted successfully.']);
    }
}
