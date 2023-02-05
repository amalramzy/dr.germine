<?php
namespace App\Helpers;


class ResMesg
{
    public static function notUrChild() {
        return response()->json(["message"=> "not your child"],$status=400);
    }
    public static function emailSent() {
        return response()->json(["message"=> "email with password reset link has been sent to your email"],$status=200);
    }
    public static function emailExists() {
        return response()->json(["message"=> "Email Exists"],$status=400);
    }
    public static function passDoesntMatch() {
        return response()->json(["message"=> "your password doesn't match the provided one doesn't match"],$status=400);
    }
    public static function passIsSame() {
        return response()->json(["message"=> "New Password cannot be same as your current password. Please choose a different password."],$status=400);
    }
    public static function passChanged() {
        return response()->json(["message"=> "Password changed successfully !"],$status=200);
    }
    public static function WrongCardin() {
        return response()->json(["message"=> "Wrong Credentials"],$status=400);
    }
}
