<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Represervation;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Carbon;
use App\Models\Slot;
use App\Models\SalePerson;

class RepReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $dueDate = Carbon::now()->addDays(3);
        $nowDate = Carbon::now();
        $slots =Slot::whereDate('date','>=',$nowDate)->whereDate('date','<=',$dueDate)->get();

        if ($request->ajax()) {
            $data = Represervation::where('status','!=','finished')->latest()->get();
            return $this->  repResrvationCurrentDatatable($data);

        }
        return view('admin.represervation.index',compact('slots'));
    }

    /**
     * function previous rep
     */
    public function repPreviousVisits (Request $request){
            $to = $request->from;
            $from = $request->to;

            if ($request->ajax()) {

                $dayNow = Carbon::now();
                $date = explode(",", $request->date);
                // $date[0] > from , $date[1] > to
                $data =  $request->date  ? Represervation::whereDate('special_datetime', '>=', $date[0])->whereDate('special_datetime', '<=',  $date[1])->get():
                    Represervation::whereDate('special_datetime','<', $dayNow)->orWhere('status','finished')->get();

                return  $this->repResrvationPreviousDatatable($data);
            }

            return view('admin.represervation.previous',compact('to','from'));
    }



    public function repResrvationCurrentDatatable($data){
        return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('appointments', function($row){

             $soltid = $row->slot_id;
             $specialTime = $row->special_datetime ;
            if($soltid == null){
                $fullDate = Carbon::parse( $specialTime)->translatedFormat('l d-m-Y');
                return $fullDate ." Specific ";
            }if($soltid != null){
                $slottable = Slot::where('id','=', $soltid)->first();
                $fullDate =  Carbon::parse($slottable->date)->translatedFormat('l d-m-Y');
                $row->special_datetime == null;
                return $fullDate;
            }

        })
        ->addColumn('name', function($row){
            $salePerson = $row->salePerson_id;
            $name = SalePerson::where('id',$salePerson)->first();
            $saleName = $name->name;
            return $saleName;
        })
        ->addColumn('phone', function($row){
            $salePerson_phone = $row->salePerson->phone;

            return $salePerson_phone;
        })
        ->addColumn('arrive_time', function($row){
            if($row->arrive_time != NULL){
                $time = Carbon::parse($row['arrive_time'])->translatedFormat('h:i a');
                return $time;
            }
            else{

                $btn = '<form method="POST" action= "'.route('rep.timeArrive.store',[$row->id]).'">'.csrf_field().'<button  data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Add" class="addTime " style= "border:none;background-color:transparent;color:#4ec0e7;"><i class="mdi mdi-eye-outline"></i></button></form>';
                return $btn;
            }

        })
        ->addColumn('enter_time', function($row){
            if($row->enter_time != NULL){
                $time = Carbon::parse($row['enter_time'])->translatedFormat('h:i a');
                return $time;
            }else{

                $btn = '<form method="POST" action= "'.route('rep.timeEnter.store',[$row->id]).'">'.csrf_field().'<button  data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Add" class="addTime " style= "border:none;background-color:transparent;color:#4ec0e7;"><i class="mdi mdi-eye-outline"></i></button></form>';
                return $btn;
            }
        })
        ->addColumn('finish_time', function($row){
            if($row->finish_time != NULL){
                $time = Carbon::parse($row['finish_time'])->translatedFormat('h:i a');
                return $time;
            }else{

                $btn = '<form method="POST" action= "'.route('rep.timeFinish.store',[$row->id]).'">'.csrf_field().'<button  data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Add" class="addTime " style= "border:none;background-color:transparent;color:#4ec0e7;"><i class="mdi mdi-eye-outline"></i></button></form>';
                return $btn;
            }
        })
        ->addColumn('canceled', function($row){
            if($row->status == "canceled"){
               $status = $row->status;
               return $status;
            }else{
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Cancel" class="cancel cancelReservation"><i class="mdi mdi-close"></i></a>';
                return $btn;
            }
        })
        ->addColumn('canceled', function($row){
            if($row->status == "canceled"){
               $status = $row->status;
               return $status;
            }else{
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Cancel" class="cancel cancelReservation"><i class="mdi mdi-close"></i></a>';
                return $btn;
            }
        })
        ->addColumn('edit', function($row){
            $btn =' <a href="'.route('rep.edit.all',[$row->id]).'" data-toggle="tooltip"   data-original-title="Edit" class="edit editReservation"><i class="mdi mdi-square-edit-outline"></i></a>';
            return $btn;

        })
        ->rawColumns(['appointments','name','phone','arrive_time','enter_time','finish_time','canceled','edit'])
        ->make(true);

    }


    /**
     * return dataTables for prevoius Rep
     */
    public function repResrvationPreviousDatatable($data){
        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('name', function ($row) {
            return $row->salePerson->name;
        })
        ->addColumn('company', function ($row) {
            return $row->salePerson->company;
        })
        ->addColumn('medicines', function ($row) {
            return $row->salePerson->medicines;
        })
        ->addColumn('appointments', function($row){
            $specialTime = $row->special_datetime;
            $fullDate = Carbon::parse($specialTime)->translatedFormat('Y-m-d').'<br>'. Carbon::parse($specialTime)->translatedFormat('g:i A');
            return $fullDate;

        })
        ->addColumn('edit', function($row){
            $btn =' <a href="'.route('represervation.edit',[$row->id]).'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit editReservation"><i class="mdi mdi-square-edit-outline"></i></a>';
            return $btn;

        })
        ->addColumn('delete', function($row){
            $form = '<form id="delete-form" method="post" action="'.route('represervation.destroy',$row->id).'">'. csrf_field() . method_field('Delete') .'</form>';
            $btn =$form .' <a onClick="if(confirm(\''. __('messages.Are You sure want to delete !') .'\')){ document.getElementById(\'delete-form\').submit();}" href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="delete editReservation"><i class="mdi mdi-delete"></i></a>';
            return $btn;
        })
        ->rawColumns(['name','company','medicines','appointments','edit','delete'])
        ->make(true);
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


        $represervation= Represervation::updateOrCreate(
            [

                'id' => $request->represervation_id
            ],
            [
                'salePerson_id' => $request->salePerson_id,

                'comment' => $request->comment,
                'doctor_comment' => $request->doctor_comment,
                'secretarial_comment' => $request->secretarial_comment,
                'slot_id'=>$request->slot_id,
                'special_datetime'=>$request->date,
            ]
        );

        if($represervation->slot_id != 'null'){
            $slottable = Slot::where('id','=', $represervation->slot_id)->first();
            $fullDate =  Carbon::parse($slottable->date)->translatedFormat('Y-m-d');
            $fullTime = Carbon::parse($slottable->from)->translatedFormat('H:i:s');
            $represervation->special_datetime = $fullDate.' '.$fullTime;
            $represervation->save();
        }

            if($request->ajax())
                return response()->json(['success'=>'Reservation Updated successfully.']);
            return redirect()->route('visit.current');


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
        $represervation = Represervation::find($id);
        return view('admin.represervation.edit',compact('represervation'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editAll($id)
    {
        $dueDate = Carbon::now()->addDays(3);
        $nowDate = Carbon::now();
        $slots =Slot::whereDate('date','>=',$nowDate)
                                     ->whereDate('date','<=',$dueDate)->get();
        $represervation = Represervation::find($id);
        return view('admin.represervation.editAll',compact('represervation','slots'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request, $id)
     {

         $represervation = Represervation::find($id);
         $represervation->update($request->all());
         return back();


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Represervation::find($id)->delete();
        return back();
        return response()->json(['success'=>'Resevation deleted successfully.']);
    }
}
