<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Clinc;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ClincController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
  
            $data = Clinc::latest()->get();
  
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit editClinc"><i class="mdi mdi-square-edit-outline"></i></a>';
                          
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="delete deleteClinc"><i class="mdi mdi-delete"></i></a>';
                                
                           return $btn;
                    })
                  
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('admin.clinc.index');
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
        Clinc::updateOrCreate([
            'id' => $request->clinc_id
        ],
        [
            'name'=> $request->name,
            'title'=>$request->title,
            'location_url'=>$request->location_url
        ]
    );        

       return response()->json(['success'=>'Clinc saved successfully.']);
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
        $clinc = Clinc::find($id);
        return response()->json($clinc);
    }

 

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Clinc::find($id)->delete();
      
        return response()->json(['success'=>'Clinc deleted successfully.']);
    }
}