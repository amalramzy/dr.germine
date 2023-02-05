<?php

namespace App\Models;

use App\Notifications\AllSalePersonNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AllUserNotification;
use App\Notifications\OneUserNotification;

class Message extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
       
    ];

    public function notifyUsers(){
        $users = User::all();

        Notification::send($users,new AllUserNotification($this));

        // return $users;
       
    }

    public function notifyOneUser($id){
        $user = User::where('id',$id)->get();
        Notification::send($user,new OneUserNotification($this));

        // return $user;
       
    }

    public function notifySalePerson(){
        $salepersons = SalePerson::all();
        Notification::send($salepersons,new AllSalePersonNotification($this));
    //    return $salepersons;
    }

    // public function notifySelectUser(){
       
    // }

     public function calc($n){
        $today = date("y-m-d");
        $calc = date_diff(date_create($n), date_create($today));

        $childOfDays  = $calc->format('%a day');
        return $childOfDays;
    }
}
