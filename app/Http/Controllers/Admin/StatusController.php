<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Represervation;
use Illuminate\Support\Facades\DB;
use App\Models\Reservation;
use App\Models\User;
use Carbon\Carbon;

class StatusController extends Controller
{
    public function statusCancleForRep($id)
    {
    Represervation::find($id)->update(

    ['status' => "canceled"]
    );
    // return back();
    return response()->json(['success'=>'Resevation canceled successfully.']);

    }

    public function statusCanceledReservation($id)
    {
    Reservation::find($id)->update(

    ['status' => "canceled"]
    );

    return response()->json(['success'=>'Resevation canceled successfully.']);

    }


    public function statusCanceledAllReservationTODay(){
        $reservations = Reservation::whereDate('special_datetime',Carbon::today())->where('status','pending')->get();

       foreach($reservations as $reservation){
        $child = $reservation->child;
        $user = $child->user;
        $user->cancel_count = $user->cancel_count + 1;
        $user->save();
        $reservation->update(

            ['status' => "canceled"]);
       }
       return back();
    }

    public function statusCloseClinc(){
        $reservations = Reservation::whereDate('special_datetime',Carbon::today())->where('status','pending')->where('arrive_time',null)->get();

       foreach($reservations as $reservation){
        $child = $reservation->child;
        $user = $child->user;
        $user->no_attended_count = $user->no_attended_count + 1;
        $user->save();
        $reservation->update(

            ['status' => "canceled"]);
       }
       return back();
    }

}
