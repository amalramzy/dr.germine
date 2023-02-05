<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Child;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function myChildren()
    {
        $user = Auth::user();
        return Child::where('user_id', $user->id)->get();
    }


    public function index(Request $request)
    {

        if ($request->ajax()) {
            if ($request->has('block')) {
                $data = User::where('block', $request->block)->latest()->get();
            } else if ($request->has('choose_area_id')) {
                $data = User::where('area_id', $request->choose_area_id)->latest()->get();
            } else {
                $data = User::latest()->get();
            }

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit editUser"><i class="mdi mdi-square-edit-outline"></i></a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="delete deleteUser"><i class="mdi mdi-delete"></i></a>';

                    //    $btn = $btn.' <a href="'.route('users.show',[$row->id]).'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="show showUser"><i class="mdi mdi-eye-outline"></i></a>';
                    return $btn;
                })
                // ->addColumn('area',function($row){

                //     $area = $row->area_id;
                //         return $area
                //     })
                ->addColumn('father', function ($row) {
                    $name = $row->father;
                    $userShow = '<a href="' . route('users.show', [$row->id]) . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="show showUser">' . $name . '</a>';
                    return $userShow;
                })
                ->addColumn('block', function ($row) {
                    if ($row->block == 1) {
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . "-" . $row->block . '" data-original-title="Block" class="edit blockUser"><i class="mdi mdi-account-check"></i></a>';
                    } else {
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . "-" . $row->block . '" data-original-title="Block" class="edit blockUser"><i class="mdi mdi-account-cancel"></i></a>';
                    }
                    return $btn;
                })
                ->addColumn('change_password', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="changePassword" class="edit changePassword"><i class="mdi mdi-key"></i></a>';

                    return $btn;
                })
                ->addColumn('children', function ($row) {
                    $children = Child::where('user_id', $row->id)->get();
                    $userShow = "";
                    foreach ($children as $child) {
                        $userShow = $userShow . '<a href="' . route('children.show', [$child->id]) . '" data-toggle="tooltip"  data-id="' . $child->id . '" data-original-title="Delete" class="show showUser">' . $child->name . '</a> <br>';
                    }
                    return $userShow;
                })
                ->addColumn('area_id', function ($row) {
                    $name = @$row->area->name;
                    return $name;
                })
                ->addColumn('created_at', function ($row) {
                    $formatDate = Carbon::parse($row->created_at)->translatedFormat('d-m-Y');
                    return $formatDate;
                })
                ->rawColumns(['action', 'father', 'children', 'block', 'change_password'])
                ->make(true);
        }
        if ($request->block) {
            $block = $request->block;
            return view('admin.user.index', compact('block'));
        }
        if ($request->has('choose_area_id')) {
            $choose_area_id = $request->choose_area_id;
            return view('admin.user.index', compact('choose_area_id'));
        }

        return view('admin.user.index');
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
    public function store(UserRequest $request)
    {
        $user = User::updateOrCreate(
            [
                'id' => $request->user_id
            ],
            [
                'father' => $request->father,
                'mother' => $request->mother,
                'area_id' => $request->area_id,
                'email' => $request->email,
                'phone1' => $request->phone1,
                'phone2' => $request->phone2,

                'password' => Hash::make($request->password)
            ]
        );
        if ($request->password) {
            $user->password = Hash::make($request->password);
            $user->save();
        }
        return response()->json(['success' => 'User saved successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, User $user)
    {
        // $user = User::find($id);
        // $child = Child::where('user_id','=',$id)->get();
        // dd($child);
        if ($request->ajax()) {

            //$data = $user->children;
            $data = Child::where('user_id', '=', $user->id)->get();
            //   dd($data);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit editChild"><i class="mdi mdi-square-edit-outline"></i></a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="delete deleteChild"><i class="mdi mdi-delete"></i></a>';

                    return $btn;
                })
                ->addColumn('name', function ($row) {
                    $name = $row->name;
                    $childShow = '<a href="' . route('children.show', [$row->id]) . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="show showUser">' . $name . '</a>';
                    return $childShow;
                })

                ->rawColumns(['action', 'name'])
                ->make(true);
        }

        return view('admin.user.show', compact('user'));

        // return response()->json($user);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();

        return response()->json(['success' => 'User deleted successfully.']);
    }


    public function block($id)
    {
        $user = User::find($id);
        if ($user->block == 0) {
            $user->block = "1";
        } else {
            $user->block = "0";
        }
        $user->update();
        return response()->json(['success' => 'User blocked successfully.']);
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $user = User::find($request->user_id);
        $user->password = Hash::make($request->password);
        $user->update();
        return response()->json(['success' => 'Password Changed successfully.']);
    }
}
