<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SlotsRequest;
use App\Models\Slot;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Carbon;
use App\Models\Clinc;
class SlotsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clincs = Clinc::all();
        $clincCount = Clinc::count();
        // $time="15:30:30";
        // $newtimeFrom = date('g:i a',$time);
        // dd($newtimeFrom);
        if ($request->ajax()) {
  
            $data = Slot::latest()->get();
  
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit editSlot"><i class="mdi mdi-square-edit-outline"></i></a>';
                          
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="delete deleteSlot"><i class="mdi mdi-delete"></i></a>';
                                
                           return $btn;
                    })
                    ->addColumn('date', function($row){
                       
                        
                        // $fullDate = date_format( date_create($row['date']),"l d-m-Y");
                       $fullDate =  Carbon::parse($row['date'])->translatedFormat('l d-m-Y');
                        return $fullDate;
                   
                    })
                    ->addColumn('from', function($row){
                       
                        
                        // $fullDate = date_format( date_create($row['from']),'h:i a');
                       $time = Carbon::parse($row['from'])->translatedFormat('h:i a');
                        return $time;
                   
                    })
                    ->addColumn('to', function($row){
                       
                        
                        // $fullDate = date_format( date_create($row['to']),'h:i a');
                        $time = Carbon::parse($row['to'])->translatedFormat('h:i a');
                        return $time;
                   
                    })
                    ->rawColumns(['action','date','from','to'])
                    ->make(true);
        }
        
        return view('admin.slot.index',compact('clincCount','clincs'));
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
    public function store(SlotsRequest $request)
    {
        Slot::updateOrCreate([
            'id' => $request->slot_id
        ],
        [
            'date'=>$request->date,
            'from'=>$request->from,
            'to'=>$request->to,
            'number'=>$request->number,
            'clinc_id'=>$request->clinc_id
            // 'date'=> date("l d-m-Y", strtotime($request->date)),
            // 'from'=>date('h:i a', strtotime($request->from)),
            // 'to'=>date('h:i a', strtotime($request->to)),
            // 'number'=>$request->number
            // 'date' => ['en'=>$request->date_en,'ar'=>$request->date_ar]
        ]
    );        

       return response()->json(['success'=>'Appointment saved successfully.']);
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
        $slot = Slot::find($id);
        return response()->json($slot);
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
        Slot::find($id)->delete();
      
        return response()->json(['success'=>'slot deleted successfully.']);
    }
}
