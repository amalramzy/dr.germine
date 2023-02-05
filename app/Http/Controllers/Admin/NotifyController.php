<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NotifyRequest;
use App\Models\Area;
use App\Models\Child;
use App\Models\Message;
use App\Models\Notify;
use App\Models\Reservation;
use App\Models\SalePerson;
use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\SelectUserNotification;
use Carbon\Carbon;

class NotifyController extends Controller
{
    public function indexNotify(){
        return view('admin.notify.index');
    }

    public function sendOneUser(NotifyRequest $request, User $user){
        $user = User::find($user->id);
        $notify = new Notify($request->all());
        $user->notifications()->save($notify);

        return redirect()->back();

    }

    public function sendAllUser(NotifyRequest $request){
        $users = User::all();


         foreach($users as $user){
            $notify = new Notify($request->all());

            $user->notifications()->save($notify);

         }
         $medicalReps = SalePerson::all();


         foreach($medicalReps as $medicalRep){
            $notify = new Notify($request->all());

            $medicalRep->notifications()->save($notify);

         }

        //  $users->notifications()->save($notify);

        // $notify->notifyUsers();

        return redirect()->route('notify.index');

    }


    public function sendAllPerson(NotifyRequest $request){
        $medicalReps = SalePerson::all();


         foreach($medicalReps as $medicalRep){
            $notify = new Notify($request->all());

            $medicalRep->notifications()->save($notify);

         }

        return redirect()->route('notify.index');

    }

    public function sendSelectUser(NotifyRequest $request){
        $areas = $request->area ? [$request->area] : Area::all()->pluck('id');
        $genders = $request->gender ? [$request->gender] : ['male','female'];
        if($request->age==="all" || !$request->age){
            $userIds = User::whereIn('area_id',$areas)->get()->pluck('id');
            $userIds2= Child::whereIn('user_id',$userIds)->whereIn('gender',$genders)->get()->pluck('user_id');
        }else{
            //dayfrom
            $dayFrom= $request->get('day1')??1;
            //monthfrom
            $monthFrom = $request->get('month1')??1;
            //yearfrom
            $yearFrom = $request->get('year1')??2000;
            //agefrom
            $ageFrom = $yearFrom . '-' . $monthFrom . '-' . $dayFrom;

            //dayto
            $dayTo= $request->get('day2') ?? date('d');
            //monthto
            $monthTo = $request->get('month2')?? date('m');
            //yearto
            $yearTo = $request->get('year2')??date('Y');
            //ageto
            $ageTo = $yearTo . '-' . $monthTo . '-' . $dayTo;

            $userIds = User::whereIn('area_id',$areas)->get()->pluck('id');
            $userIds2= Child::whereIn('user_id',$userIds)->whereDate('birthdate','>=', $ageFrom)
            ->whereDate('birthdate','<=', $ageTo)
            ->whereIn('gender',$genders)->get()->pluck('user_id');
        }

        $users = User::whereIn('id',$userIds2)->get();
        foreach($users as $user){
            $notify = new Notify($request->all());
            $user->notifications()->save($notify);
        }
        return redirect()->route('notify.index');
    }



    public function sendAllUserToday(Request $request){
        // today reservation
        if($request->ajax()){
            $inputs =$request->all();
            $inputs['type'] = 'mine';
            $reservations = Reservation::whereDate('special_datetime',Carbon::today())->get();
            $notify = new Notify($inputs);
         foreach($reservations as $res){
            $res->child->user->notifications()->save($notify);
         }
        }
    }


}
