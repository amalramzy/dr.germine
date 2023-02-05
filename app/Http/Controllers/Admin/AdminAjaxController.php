<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminAjaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {    
        if ($request->ajax()) {
  
            $data = Admin::latest()->get();
  
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit editAdmin"><i class="mdi mdi-square-edit-outline"></i></a>';
                           if( \Illuminate\Support\Facades\Auth::guard('admin')->user()->id!=$row->id)
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="delete deleteAdmin"><i class="mdi mdi-delete"></i></a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('admin.adminAjax');
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
    public function store(AdminRequest $request)
    {
      $admin=  Admin::updateOrCreate([
                    'id' => $request->admin_id
                ],
                [
                    'name' => $request->name, 
                    'email' => $request->email,
                    'password' => Hash::make($request->password)
                ]
            );        
            if($admin){
                $admin->password= Hash::make($request->password);
                $admin->save();
            }   
        return response()->json(['success'=>'Admin saved successfully.']);
    }
   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = Admin::find($id);
        return response()->json($admin);
    }

    // public function update(Request $request)
    // {
    //     $admin = Admin::findOrFail($id);
    //     $admin->update($request->except('password'));
    //     if($request->password){
    //         $admin->password= Hash::make($request->password);
    //         $admin->save();
    //     }
    //     return response()->json(['success'=>'Admin Updated successfully.']);

    // }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Admin::find($id)->delete();
      
        return response()->json(['success'=>'Admin deleted successfully.']);
    }
}
