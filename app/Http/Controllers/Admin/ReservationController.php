<?php

namespace App\Http\Controllers\Admin;

use App\Events\ReservationEnteranceEvent;
use App\Http\Controllers\Controller;
use App\Models\AvailableFollowUp;
use App\Models\Reservation;
use App\Models\Slot;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Child;
use App\Models\Represervation;
use PhpParser\Node\Stmt\Else_;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Reservation::latest()->get();
            return $this->resrvationDatatable($data);
        }

        return view('admin.reservation.index');
    }
    public function currentVisits (Request $request){



        if($request->comment &&$request->id){
           $res = Reservation::find($request->id);
           $res->update(['secretarial_comment'=> $request->comment]);
           return redirect()->route('visit.current');
        }

        if($request->price &&$request->id){
            $res = Reservation::find($request->id);
            $res->update(['price'=> $request->price]);
            return redirect()->route('visit.current');
         }


        $date = $request->date;
        $date = $date ? $date: Carbon::today();
        $slotsForDay = Slot::whereDate('date',$date)->get()->pluck('id')->toArray();

        $represervations = Represervation::orWhereIn('slot_id',$slotsForDay)->orWhereDate('special_datetime',$date)->get();

        //$reservedSlots = \App\Models\Slot::whereIn('id',array_unique(\App\Models\Represervation::whereIn('slot_id',$slotsForDay)->get()->pluck('slot_id')->toArray()))->paginate(10);
        //return $reservedSlots;
        //$slot= Slot::whereDate('date',$dayNow)->get();
        //$represervations = $date ?  Represervation::whereDate('special_datetime',$date)->get(): Represervation::whereDate('special_datetime',$dayNow)->get();
         $date = $request->date;
        if ($request->ajax()) {

            $date = $request->date;
            $type = $request->type;
            $dayNow = Carbon::now();
            if($type){
                $data =Reservation::where('type',$type)->where('slot_id',null)->get();
                return $this->resrvationDatatable($data);
            }
            if($date){
                $data = Reservation::where('slot_id',null)->whereDate('special_datetime', $date)->get();
                return $this->resrvationDatatable($data);
            }else{
                $data = Reservation::where('slot_id',null)->whereDate('special_datetime', $dayNow)->get();
                return $this->resrvationDatatable($data);
            }
        }

        if($request->type){
            $type = $request->type;
            return view('admin.reservation.current',compact(['type','date']));
        }

        //return $represervations;
        return view('admin.reservation.current',compact('date','represervations'));
    }

    public function previousVisits (Request $request){

        if($request->price &&$request->id){
            $res = Reservation::find($request->id);
            $res->update(['price'=> $request->price]);
            return back();
         }
        // $nowDate = Carbon::now();
        // $slots =Slot::whereDate('date','<',$nowDate)->get();
        $date = $request->date;

        if ($request->ajax()) {
            $date = $request->date;
            $type = $request->type;
            $dayNow = Carbon::now();
            if($type){
                $data =Reservation::where('type',$type)->get();
                return $this->resrvationPreviousDatatable($data);
            }
            if($date){
                $data =Reservation::whereDate('special_datetime', $date)->get();
                return $this->resrvationPreviousDatatable($data);
            }else{
                $data = Reservation::whereDate('special_datetime', $dayNow->addDays(-1))->get();;
                return $this->resrvationPreviousDatatable($data);
            }
        }
        if($request->type){
            $type = $request->type;
            return view('admin.reservation.previous',compact(['type','date']));
        }
        return view('admin.reservation.previous',compact('date'));
    }




    public function resrvationDatatable($data){
       return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('name', function($row){
                return $row->child->name;
            })
            ->addColumn('mother', function($row){
                return $row->child->user->mother;
            })
            ->addColumn('father', function($row){
                return $row->child->user->father;
            })
            ->addColumn('phone', function($row){
                return $row->child->user->phone1 . '<br>' . $row->child->user->phone2;
            })
            ->addColumn('appointments', function($row){
                $specialTime = $row->special_datetime;
                $fullDate = Carbon::parse($specialTime)->translatedFormat('g:i A');
                return $fullDate;

            })
            ->addColumn('update-price', function($row){
                $modal = '<div class="modal fade" id="price'.$row->id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">'.__("messages.add_price").'</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form method="get" action="'.route('visit.current').'">

                        <input name="id" type="hidden" value="'.$row->id.'"/>
                        <div class="form-group" style="text-align: -webkit-auto;">
                          <label for="message-text" class="col-form-label">'.__("messages.price").':</label>
                          <input class="form-control" type="number" name="price" required/>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">'.__("messages.close").'</button>
                            <button type="submit" class="btn btn-primary">'.__("messages.save").'</button>
                          </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>';
                $price = $row->price .  '<a  class="price edit" data-toggle="modal" data-target="#price'.$row->id.'" data-whatever="@getbootstrap"><i class="price mdi mdi-square-edit-outline"></i></a>';
                return $price . $modal;
            })
            ->addColumn('secretarial', function($row){
                $modal = '<div class="modal fade" id="secretarial'.$row->id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">'.__("messages.add_comment").'</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form method="get" action="'.route('visit.current').'">

                        <input name="id" type="hidden" value="'.$row->id.'"/>
                        <div class="form-group">
                        <label for="message-text" class="col-form-label">'.__('messages.comment').':</label>
                        <textarea name="comment" class="form-control" id="message-text" required></textarea>
                      </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">'.__("messages.close").'</button>
                            <button type="submit" class="btn btn-primary">'.__("messages.save").'</button>
                          </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>';
                $secretarial_comment = $row->secretarial_comment .  '<a   class="price edit" data-toggle="modal" data-target="#secretarial'.$row->id.'" data-whatever="@getbootstrap"><i class="price mdi mdi-square-edit-outline"></i></a>';
                return $secretarial_comment . $modal;
            })
            ->addColumn('arrive_time', function($row){
                if($row->arrive_time != NULL){
                    $time = Carbon::parse($row['arrive_time'])->translatedFormat('h:i a');
                    return $time;
                }
                else{

                    $btn = '<form method="POST" action= "'.route('timeArrive.store',[$row->id]).'">'.csrf_field().'<button  data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Add" class="addTime " style= "border:none;background-color:transparent;color:#4ec0e7;"><i class="mdi mdi-eye-outline"></i></button></form>';
                    return $btn;
                }

            })
            ->addColumn('enter_time', function($row){
                if($row->enter_time != NULL){
                    $time = Carbon::parse($row['enter_time'])->translatedFormat('h:i a');
                    return $time;
                }else{

                    $btn = '<form method="POST" action= "'.route('timeEnter.store',[$row->id]).'">'.csrf_field().'<button  data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Add" class="addTime " style= "border:none;background-color:transparent;color:#4ec0e7;"><i class="mdi mdi-eye-outline"></i></button></form>';
                    return $btn;
                }
            })
            ->addColumn('finish_time', function($row){
                if($row->finish_time != NULL){
                    $time = Carbon::parse($row['finish_time'])->translatedFormat('h:i a');
                    return $time;
                }else{

                    $btn = '<form method="POST" action= "'.route('timeFinish.store',[$row->id]).'">'.csrf_field().'<button  data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Add" class="addTime " style= "border:none;background-color:transparent;color:#4ec0e7;"><i class="mdi mdi-eye-outline"></i></button></form>';
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
                $btn =' <a href="'.route('reservation.edit',[$row->id]).'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit editReservation"><i class="mdi mdi-square-edit-outline"></i></a>';

                //   $btn = '<a href="'.{{route('reservation.edit.previous',['child'=>$child,'reservation'=>$reservation])}}.'"  class="btn btn-success showReservation"><i class="mdi mdi-square-edit-outline"></i></a>'

                // $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit editReservation"><i class="mdi mdi-square-edit-outline"></i></a>';
                return $btn;

            })
            // ->addColumn('type', function($row){
            //     $type = $row->type;
            //     if($type == "vaccination"){
            //         $type = "{{__('messages.Vaccination')}}";
            //         return $type;
            //     }
            // })
            ->rawColumns(['name','father','mother','phone','appointments','update-price','secretarial','arrive_time','enter_time','finish_time','canceled','edit'])
            ->make(true);
    }

    public function resrvationPreviousDatatable($data){
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('appointments', function($row){
                $specialTime = $row->special_datetime;
                $fullDate = Carbon::parse($specialTime)->translatedFormat('l d-m-Y') . '<br> ' .Carbon::parse($specialTime)->translatedFormat('g:i A') ;
                    return $fullDate ;//. __("Specific");

            })
            ->addColumn('name', function($row){
                    return $row->child->name;
            })
            ->addColumn('diagnostics', function($row){
                $diags = $row->diagnostics;
                $text = '';
                foreach($diags as $diag){
                 $text .= $diag->name. ',' ;
                }
                return $text;
             })
             ->addColumn('follow-up', function($row){
                if($row->is_follow_up == 0){
                    return '--';
                }else{
                    $date = $row->where('parent_id',$row->id)->pluck('special_datetime','parent_id')->first();
                   $fullDate = Carbon::parse($date)->translatedFormat('l d-m-Y') . '<br>' .Carbon::parse($date)->translatedFormat('g:i A') ;
                   return $fullDate;

                }
             })->addColumn('update-price', function($row){
                $modal = '<div class="modal fade" id="price'.$row->id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">'.__("messages.add_price").'</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form method="get" action="'.route('visit.previous').'">

                        <input name="id" type="hidden" value="'.$row->id.'"/>
                        <div class="form-group" style="text-align: -webkit-auto;">
                          <label for="message-text" class="col-form-label">'.__("messages.price").':</label>
                          <input class="form-control" type="number" name="price" required/>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">'.__("messages.close").'</button>
                            <button type="submit" class="btn btn-primary">'.__("messages.save").'</button>
                          </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>';
                $price = $row->price .  '<a   class="price edit" data-toggle="modal" data-target="#price'.$row->id.'" data-whatever="@getbootstrap"><i class="price mdi mdi-square-edit-outline"></i></a>';
                return $price . $modal;
            })
            ->rawColumns(['appointments','name','diagnostics','follow-up','update-price'])
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
        $slot_order =0;
        if ($request->has('slot_id') && $request->slot_id != "00")
        {
            $slot = Slot::find($request->slot_id);
            if ($slot && !$slot->is_full){
                $slot_order = $slot->reserved +1;
                $slot->reserved =$slot_order;
                $slot->save();
            }
            else{
                return response()->json(['message'=>'invalid slot'],400);

            }
        }
        // check slot is valid
        // if valid update slot reserved
        // add slot order to reservation

        $parent_id = null;
        if ($request->is_follow_up) {
            $avFollowUp = AvailableFollowUp::where('child_id', $request->child_id)->first();
            if ($avFollowUp){
                $parent_id = $avFollowUp->reservation_id;
                $avFollowUp->delete();

            }
        }
       $reservation= Reservation::updateOrCreate(
        [
            'child_id' => $request->child_id,
            'type' => $request->type,
            'patient_comment' => $request->patient_comment,
            'secretarial_comment' => $request->secretarial_comment,
            'slot_id'=>$request->slot_id == "00" ? null : $request->slot_id,
            'special_datetime'=>$request->date,
            'slot_order'=>$slot_order,
            'is_follow_up'=>$request->is_follow_up,
            'parent_id' => $parent_id

        ]);

    if($reservation->slot_id){
        $slottable = Slot::where('id','=', $reservation->slot_id)->first();

        $fullDate =  Carbon::parse($slottable->date)->translatedFormat('Y-m-d');

        $fullTime = Carbon::parse($slottable->from)->translatedFormat('H:i:s');

        $reservation->special_datetime = $fullDate.' '.$fullTime;
        $reservation->save();

    }
    $reservation->vaccin_id = $reservation->vaccinations()->attach($request->vaccin_id);

    $returnHtTML = view('admin.reservation.current',['reservation'=>$reservation])->render();
    return response()->json(array('success'=>true,'html'=>$returnHtTML));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $reservation = Reservation::find($id);
      return response()->json($reservation);
    }


    public function summary(Request $request,Child $child){
        if ($request->ajax()) {
            $data = $child->reservations()->get();
         return Datatables::of($data)
         ->addIndexColumn()
         ->addColumn('special_datetime', function($row){
            return Carbon::parse($row->special_datetime)->translatedFormat('l d-m-Y');

        })

        ->rawColumns(['special_datetime'])
         ->make(true);
        }

        return view('admin.child.summary',compact('child'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $reservation = Reservation::find($id);
        $today = date("Y-m-d");
        $child = Child::where('id',$reservation->child_id)->first();
        $calc = date_diff(date_create($child->birthdate), date_create($today));
        $childDays = $calc->format('%a');

        $dueDate = Carbon::now()->addDays(3);
        $nowDate = Carbon::now();
        $slots =Slot::whereDate('date','>=',$nowDate)
                                     ->whereDate('date','<=',$dueDate)->get();
        // $child = Child::where('id',$reservation->child_id)->get();
        return view('admin.reservation.edit',compact(['reservation','childDays','slots']));
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
        $reservation = Reservation::find($id);
        $reservation->update($request->all());

        if($reservation->slot_id){

            $slottable = Slot::where('id','=', $reservation->slot_id)->first();
            $fullDate =  Carbon::parse($slottable->date)->translatedFormat('Y-m-d');
            $fullTime = Carbon::parse($slottable->from)->translatedFormat('H:i:s');
            $reservation->special_datetime = $fullDate.' '.$fullTime;
            $reservation->save();
        }
        $reservation->vaccin_id = $reservation->vaccinations()->sync($request->vaccin_id);
        return redirect()->route('visit.current');
    }

    public function destroy(Reservation $reservation){
        $reservation->delete();
        return redirect()->back();
    }

}
