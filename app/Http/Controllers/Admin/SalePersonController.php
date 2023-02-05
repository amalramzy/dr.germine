<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ResMesg;
use App\Http\Controllers\Controller;
use App\Http\Requests\PersonRequest;
use App\Models\SalePerson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ChangePasswordRequest;

class SalePersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            if ($request->has('block')) {
                $data = SalePerson::where('block', $request->block)->latest()->get();
            } else {
                $data = SalePerson::latest()->get();
            }
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit editPerson"><i class="mdi mdi-square-edit-outline"></i></a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="delete deletePerson"><i class="mdi mdi-delete"></i></a>';

                    return $btn;
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
                ->addColumn('medicines', function ($row) {
                    $userShow = "";
                    $medicines = $row->medicines;
                    $medicines = explode(",", $medicines);
                    foreach ($medicines as $medicine) {
                        $userShow = $userShow . '<p>' . $medicine . '</p>';
                    }
                    return $userShow;
                })
                ->addColumn('image', function ($row) {
                    if ($row->image != null) {
                        $image = '<img src="' . $row->image . '" class="img-thumbnail">';
                    } else {
                        $image = '<img src="../assets/images/users/user-def.png" class="img-thumbnail">';
                    }
                    return $image;
                })
                ->rawColumns(['action', 'image', 'block', 'change_password', 'medicines'])
                ->make(true);
        }
        if ($request->block) {
            $block = $request->block;
            return view('admin.sale-person.index', compact('block'));
        }
        return view('admin.sale-person.index');
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
    public function store(PersonRequest $request)
    {
        $person = SalePerson::updateOrCreate(
            [
                'id' => $request->person_id
            ],
            [

                'company' => $request->company,
                'phone' => $request->phone,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'medicines' => $request->medicines,
            ]
        );
        if ($person) {
            if ($request->hasFile('image')) {
                $person->clearMediaCollection('image');
                $person->addMedia($request->file('image'))->toMediaCollection('image');
            }
        } else {
            if ($request->file('image')) {
                $person->addMedia($request->file('image'))->toMediaCollection('image');
            }
        }
        if ($request->password) {
            $person->password = Hash::make($request->password);
        }
        if ($request->medicines) {
            $medicines = implode(', ', $request->medicines);
            $person->medicines = $medicines;
            $person->save();
        }
        return response()->json(['success' => 'Sale Person saved successfully.']);
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
        $saleperson = SalePerson::find($id);
        return response()->json($saleperson);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SalePerson::find($id)->delete();

        return response()->json(['success' => 'Sale Person deleted successfully.']);
    }

    public function block($id)
    {
        $SalePerson = SalePerson::find($id);
        if ($SalePerson->block == 0) {
            $SalePerson->block = "1";
        } else {
            $SalePerson->block = "0";
        }
        $SalePerson->update();
        return response()->json(['success' => 'SalePerson blocked successfully.']);
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $SalePerson = SalePerson::find($request->user_id);
        $SalePerson->password = Hash::make($request->password);
        $SalePerson->update();
        return response()->json(['success' => 'Password Changed successfully.']);
    }
}
