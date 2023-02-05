<?php
namespace App\Helpers;

use App\Mail\ForgotPassword;
use App\Models\PasswordResetModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class SendMail
{
    public static function sendto($email) {
       $token = RandomStr::generate(10);
       PasswordResetModel::create(['email'=>$email,"token"=>Hash::make($token),'created_at'=>Carbon::now()->toDateTimeString()]);
       Mail::to($email)->send(new ForgotPassword($email,$token));
       return "done";
    }
}
