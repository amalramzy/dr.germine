<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {    
        if ($request->ajax()) {
  
            $data = Doctor::latest()->get();
  
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="'.route('doctors.edit',[$row->id]).'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit editDoctor"><i class="mdi mdi-square-edit-outline"></i></a>';
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="delete deleteDoctor"><i class="mdi mdi-delete"></i></a>';

                            return $btn;
                    })
                    ->addColumn('name',function($row){
                        
                        $name = $row->name;
                        $doctorShow = '<a href="'.route('doctors.show',[$row->id]).'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="show showDoctor">'.$name.'</a>';
                        return $doctorShow;
                        })
                    
                    ->rawColumns(['action','name'])
                    ->make(true);
        }
        
        return view('doctor.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('doctor.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $doctor=new Doctor();
        $doctor->name = ['en'=>$request->name_en,'ar'=>$request->name_ar];
        $doctor->email = $request->email;
        $doctor->address = $request->address;
        $doctor->bio = $request->bio;
        $doctor->password= Hash::make($request->password);
        $doctor->save();
        if ($request->hasFile('document')) {
            $documents = $doctor->addMultipleMediaFromRequest(['document'])
                ->each(function ($documents) {
                    $documents->toMediaCollection('documents');
                });
        }

        return redirect(route('doctors.index'));
    }
    public function show($id)
    {
        $doctor = Doctor::find($id);
      
        return view('doctor.show',compact(['doctor'])); 
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('doctor.edit',compact(['doctor']));
    }

    public function update(Request $request, $id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->name = ['en'=>$request->name_en,'ar'=>$request->name_ar];
        $doctor->email = $request->email;
        $doctor->address = $request->address;
        $doctor->bio = $request->bio;
        $doctor->save();
        if($request->password){
            $doctor->password= Hash::make($request->password);
            $doctor->save();
        }

        if ($request->hasFile('document')) {
            $doctor->clearMediaCollection('documents');
            $documents = $doctor->addMultipleMediaFromRequest(['document'])
                ->each(function ($documents) {
                    $documents->toMediaCollection('documents');
                });
        }
        return redirect(route('doctors.index'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Doctor::find($id)->delete();
        return response()->json(['success'=>'Doctor deleted successfully.']);    }
}
