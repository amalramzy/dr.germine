<?php

namespace App\Http\Controllers\Admin;

use App\Events\ReservationEnteranceEvent;
use App\Http\Controllers\Controller;
use App\Models\Represervation;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class TimeController extends Controller
{


    // arraive time form reservation
    public function timeArrive($id)
    {
        $current_date_time = date('H:i:s');
        $reservation = Reservation::find($id);
//        if ($reservation->status != "arrived" || $reservation->status != "pending")
//            return redirect()->back()->withErrors(['this reservation already arrived ']);


        DB::table('reservations')->where('id', $reservation->id)->update(

            ['arrive_time' => $current_date_time,'status'=>'arrived']
        );
        return back();

    }

    public function timeEnter($id)
    {
        $current_date_time = date('H:i:s');
        $active_reservation = Reservation::where('status','entered')->first();
        if ($active_reservation)
            return redirect()->back()->withErrors(['there is a reservation already in ']);
        $reservation = Reservation::find($id);

        if ($reservation->status == "canceled" || $reservation->status == "finished")
            return redirect()->back()->withErrors(['this reservation already finished or canceled ']);

        DB::table('reservations')->where('id', $reservation->id)->update(

            ['enter_time' => $current_date_time,'status'=>'entered']
        );
        event(new ReservationEnteranceEvent());
        return back();

    }

    public function timeFinish($id)
    {
        $current_date_time = date('H:i:s');
        $reservation = Reservation::find($id);
        if ($reservation->status != "entered")
            return redirect()->back()->withErrors(['this reservation can\'t be finished before entrance ']);
        DB::table('reservations')->where('id', $reservation->id)->update(

            ['finish_time' => $current_date_time,'status'=>'finished']
        );
        return back();

    }



         // arraive time form represervation
         public function repTimeArrive($id)
         {
             $current_date_time = date('H:i:s');
             $represervation = Represervation::find($id);
             DB::table('represervations')->where('id', $represervation->id)->update(

                 ['arrive_time' => $current_date_time,'status'=>'arrived']
             );
             return back();

         }


         public function repTimeEnter($id)
         {
             $current_date_time = date('H:i:s');
             $active_reservation = Represervation::where('status','entered')->first();
             if ($active_reservation)
                 return redirect()->back()->withErrors(['there is a reservation already in ']);
             $reservation = Represervation::find($id);

             if ($reservation->status == "canceled" || $reservation->status == "finished")
                 return redirect()->back()->withErrors(['this reservation already finished or canceled ']);

             DB::table('represervations')->where('id', $reservation->id)->update(

                 ['enter_time' => $current_date_time,'status'=>'entered']
             );
             event(new ReservationEnteranceEvent());
             return back();

         }

         public function repTimeFinish($id)
         {
             $current_date_time = date('H:i:s');
             $reservation = Represervation::find($id);
             if ($reservation->status != "entered")
                 return redirect()->back()->withErrors(['this reservation can\'t be finished before entrance ']);
             DB::table('represervations')->where('id', $reservation->id)->update(

                 ['finish_time' => $current_date_time,'status'=>'finished']
             );
             return back();

         }

}
