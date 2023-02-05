<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OpeningRequest;
use App\Models\Opening;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Carbon;
use App\Models\Clinc;
class OpeningController extends Controller
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
        if ($request->ajax()) {

            $data = Opening::latest()->get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit editOpen"><i class="mdi mdi-square-edit-outline"></i></a>';

                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="delete deleteOpen"><i class="mdi mdi-delete"></i></a>';

                           return $btn;
                    })
                    ->addColumn('date', function($row){


                        // $fullDate = date_format( date_create($row['date']),"l d-m-Y");
                       $fullDate =  Carbon::parse($row['date'])->translatedFormat('l d-m-Y');
                        return $fullDate;

                    })
                    ->addColumn('time', function($row){


                        // $fullDate = date_format( date_create($row['from']),'h:i a');
                       $time = Carbon::parse($row['time'])->translatedFormat('h:i a');
                        return $time;

                    })
                ->addColumn('vacation', function($row){
                    return $row['is_vacation'] ? __('messages.yes') : __('messages.no') ;

                })
                    ->rawColumns(['action','date','time'])
                    ->make(true);
        }

        return view('admin.open.index',compact('clincCount','clincs'));
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
    public function store(OpeningRequest $request)
    {
        Opening::updateOrCreate([
            'id' => $request->open_id
        ],
        [
            'date'=> $request->date,
            'time'=>$request->time,
            'is_vacation'=>$request->is_vacation ?? 0,
            'clinc_id'=>$request->clinc_id

        ]
    );

       return response()->json(['success'=>'Opening saved successfully.']);
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
        $open = Opening::find($id);
        return response()->json($open);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Opening::find($id)->delete();

        return response()->json(['success'=>'opening deleted successfully.']);
    }
}
