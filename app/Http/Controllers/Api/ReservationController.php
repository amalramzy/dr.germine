<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResMesg;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRervReq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Child;
use App\Models\Reservation;
use App\Models\Vaccination;
use App\Http\Resources\VaccineResource;
use App\Models\Slot;
use App\Http\Resources\SlotResource;
use Illuminate\Support\Carbon;
use App\Http\Resources\ReservationResource;
use App\Models\ChildVaccination;
use ChildVaccinations;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationController extends Controller
{
    public function createReservation(CreateRervReq $request){
        $user = Auth::guard('api')->user();
        $slot = Slot::find($request->slot_id);
        $date =  $slot->date." ".explode(' ',Carbon::parse($slot->from))[1];
        $reservation = new Reservation($request->all());
            $reservation->child_id = $request->child_id;
            $reservation->special_datetime = $date;
            $reservation->save();

            if($request->file('images')) {
                foreach ($request->file('images') as $image) {
                    $reservation->addMedia($image)->toMediaCollection('image');
                }
            }
            return $this->jsonResponse(true, $reservation, "this Reservation saved");


    }
    public function createFollowUpReservation(CreateRervReq $request){
        $user = Auth::guard('api')->user();
        $slot = Slot::find($request->slot_id);
        $date =  $slot->date." ".explode(' ',Carbon::parse($slot->from))[1]??null;
        $reservation = new Reservation($request->all());
            $reservation->child_id = $request->child_id;
            $reservation->special_datetime = $date;
            $reservation->is_follow_up = true;
            $reservation->save();
            if($request->file('images')) {
                foreach ($request->file('images') as $image) {
                    $reservation->addMedia($image)->toMediaCollection('image');
                }
            }
            return $this->jsonResponse(true, $reservation, "this Reservation saved");

    }

    public function updateReservation(Request $request,$id){
        $user = Auth::guard('api')->user();
        $child = Child::where('user_id', '=', $user->id)->first();

        $reservation = Reservation::findOrFail($id);
        $reservation->update($request->all());
            $reservation->child_id = $child->id;

            return $this->jsonResponse(true, $reservation, "this Reservation Updated");

    }

    public function getAvailableChildVaccine($id){
        $user = Auth::guard('api')->user();
        $child = Child::where('id', $id)->first();
        if(!$child->isTheirParent($user)){
            return ResMesg::notUrChild();
        }
        $childDay = $child->age->d;
        $childYear = $child->age->y;
        $childMonth = $child->age->m;

        $childVacIds=ChildVaccination::where("child_id",$child)->pluck('vaccination_id');
        $res = Vaccination::where([
            "year"=>$childYear,
            "day"=>$childDay,
            "month"=>$childMonth
        ])->whereNotIn('id',$childVacIds)->get();
        return JsonResource::make($res);
    }

    public function getChildVaccines($id){
        $user = Auth::guard('api')->user();
        $child = Child::where('id', $id)->firstOrFail();
        if(!$child->isTheirParent($user)){
            return ResMesg::notUrChild();
        }
        $res = $child->vaccinations;
        return JsonResource::make($res);
    }

    public function getSlots(){
        $daysNum = 5;
        $dueDate = Carbon::now()->addDays($daysNum);
        $nowDate = Carbon::now();
        // return [$dueDate,$nowDate];
        $dates = Slot::all()->pluck('date')->unique();
        $res=[];
        foreach($dates as $date){
            $push=[];
            $push['date'] = $date;
            $push['slots'] = Slot::whereDate('date','>=',$nowDate)
            ->whereDate('date','<=',$dueDate)->where('date',$date)->where('reserved',0)->get();
            if(count($push['slots'])>0){
                array_push($res,$push);
            }
        }
        return $res;

        // $slots =Slot::whereDate('date','>=',$nowDate)
        //                              ->whereDate('date','<=',$dueDate)->get();

        // return SlotResource::collection($slots);

    }

    public function getSpecificDate(){

        $reservations = Reservation::where('slot_id','=', null)->get();

        return ReservationResource::collection($reservations);

    }

    public function myReservation($id){
        $user = Auth::guard('api')->user();
        $child = Child::where('user_id', '=', $user->id)->findOrFail($id);

            $reservations = $child->reservations;
            return ReservationResource::collection($reservations);
    }

    public function reservationUser(){
        $user = Auth::guard('api')->user();
        $userChild = Child::where('user_id', $user->id)->pluck('id');

        $reservations = Reservation::whereIn('child_id',$userChild)->get();
        return ReservationResource::collection($reservations);
    }

    public function statusUpdate($id)
    {
        $reservation = Reservation::find($id);

        $reservation->update(

         ['status' => "canceled"]
        );
        return $this->jsonResponse(true, $reservation, "this Reservation canceled");


    }


    public function previous(){
         $user = Auth::guard('api')->user();
         $childIds = Child::where('user_id',$user->id)->pluck('id')->unique();
        $today= Carbon::now();
        $res= Reservation::where('status','finished')->whereDate('created_at','<',$today)->whereIn('child_id',$childIds)->where('is_follow_up',false)->get();
        return $this->jsonResponse(true, $res, "");
    }
    public function upcoming(){
        $user = Auth::guard('api')->user();
        $childIds = Child::where('user_id',$user->id)->pluck('id')->unique();
        $today= Carbon::now();
        $res= Reservation::where('status','pending')->whereDate('created_at','>',$today)->whereIn('child_id',$childIds)->where('is_follow_up',false)->get();
        return $this->jsonResponse(true, $res, "");
    }
    public function previousFollowUp(){
        $user = Auth::guard('api')->user();
        $childIds = Child::where('user_id',$user->id)->pluck('id')->unique();
        $today= Carbon::now();
        $res= Reservation::where('status','finished')->whereDate('created_at','<',$today)->whereIn('child_id',$childIds)->where('is_follow_up',true)->get();
        return $this->jsonResponse(true, $res, "");
    }
    public function upcomingFollowUp(){
        $user = Auth::guard('api')->user();
        $childIds = Child::where('user_id',$user->id)->pluck('id')->unique();
        $today= Carbon::now();
        $res= Reservation::where('status','pending')->whereDate('created_at','>',$today)->whereIn('child_id',$childIds)->where('is_follow_up',true)->get();
        return $this->jsonResponse(true, $res, "");
    }
    public function oneReservation($reservId){
        $user = Auth::guard('api')->user();
        $reserv= Reservation::with('vaccinations:id,name')
        ->with('diagnostics:id,name')
        ->with('medicalTests:id,name')
        ->with('medicines:id,name')
        ->with('actualVaccinations:id,name')->with('media')
        ->where('id',$reservId)->firstOrFail();
        $child= Child::find($reserv->child_id);
        if(!$child->isTheirParent($user)){
            return ResMesg::notUrChild();
        }
        // $res = Reservation::extraInfo($reserv);
        return $this->jsonResponse(true, $reserv, "");
    }
}
