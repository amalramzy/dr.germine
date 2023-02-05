<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Reservation;
use App\Models\Child;
use App\Models\User;
class PrescriptionController extends Controller
{
    public function show($id)
    {
        $reservation = Reservation::find($id);
        $child = Child::where('id',$reservation->child_id)->first();
        $user = User::where('id',$child->user_id)->first();

            $follow_up  = Setting::where('key','follow_up_days')->first();
            $color_create  = Setting::where('key','color_create')->first();
            $color_edit  = Setting::where('key','color_edit')->first();
            $color_delete  = Setting::where('key','color_delete')->first();
            $color_main  = Setting::where('key','color_main')->first();
            $color_second  = Setting::where('key','color_second')->first();
            $logo  = Setting::where('key','logo')->first();
            $facebook  = Setting::where('key','facebook')->first();
            $youtube  = Setting::where('key','youtube')->first();
            $instagram  = Setting::where('key','instagram')->first();
            $tiktok  = Setting::where('key','tiktok')->first();
            $clinc  = Setting::where('key','clinc')->first();
            $tel  = Setting::where('key','tel')->first();
            $gallery  = Setting::where('key','gallery')->first();
            $ios_link  = Setting::where('key','ios_link')->first();
            $android_link  = Setting::where('key','android_link')->first();
            $logo2  = Setting::where('key','logo2')->first();
            $doctor_name_english  = Setting::where('key','doctor_name_english')->first();
            $doctor_name_arabic  = Setting::where('key','doctor_name_arabic')->first();

            $job_title1_english  = Setting::where('key','job_title1_english')->first();
            $job_title2_english  = Setting::where('key','job_title2_english')->first();
            $job_title3_english  = Setting::where('key','job_title3_english')->first();
            $job_title4_english  = Setting::where('key','job_title4_english')->first();

            $job_title1_arabic  = Setting::where('key','job_title1_arabic')->first();
            $job_title2_arabic  = Setting::where('key','job_title2_arabic')->first();
            $job_title3_arabic  = Setting::where('key','job_title3_arabic')->first();
            $job_title4_arabic  = Setting::where('key','job_title4_arabic')->first();

            $mobile  = Setting::where('key','mobile')->first();
            $hospital  = Setting::where('key','hospital')->first();
            $email  = Setting::where('key','email')->first();

        return view('admin.medical.prescription',compact(['user','child','reservation','email','mobile','hospital','job_title4_arabic','job_title3_arabic','job_title2_arabic','job_title1_arabic','job_title4_english','job_title3_english','job_title2_english','job_title1_english','logo2','doctor_name_arabic','doctor_name_english','follow_up','color_create','color_edit','color_delete','color_main','color_second','logo','facebook','youtube','instagram','tiktok','clinc','tel','gallery','ios_link','android_link']));
    }
    public function showMedicalTest($id)
    {
        $reservation = Reservation::find($id);
        $child = Child::where('id',$reservation->child_id)->first();
        $user = User::where('id',$child->user_id)->first();

            $follow_up  = Setting::where('key','follow_up_days')->first();
            $color_create  = Setting::where('key','color_create')->first();
            $color_edit  = Setting::where('key','color_edit')->first();
            $color_delete  = Setting::where('key','color_delete')->first();
            $color_main  = Setting::where('key','color_main')->first();
            $color_second  = Setting::where('key','color_second')->first();
            $logo  = Setting::where('key','logo')->first();
            $facebook  = Setting::where('key','facebook')->first();
            $youtube  = Setting::where('key','youtube')->first();
            $instagram  = Setting::where('key','instagram')->first();
            $tiktok  = Setting::where('key','tiktok')->first();
            $clinc  = Setting::where('key','clinc')->first();
            $tel  = Setting::where('key','tel')->first();
            $gallery  = Setting::where('key','gallery')->first();
            $ios_link  = Setting::where('key','ios_link')->first();
            $android_link  = Setting::where('key','android_link')->first();
            $logo2  = Setting::where('key','logo2')->first();
            $doctor_name_english  = Setting::where('key','doctor_name_english')->first();
            $doctor_name_arabic  = Setting::where('key','doctor_name_arabic')->first();

            $job_title1_english  = Setting::where('key','job_title1_english')->first();
            $job_title2_english  = Setting::where('key','job_title2_english')->first();
            $job_title3_english  = Setting::where('key','job_title3_english')->first();
            $job_title4_english  = Setting::where('key','job_title4_english')->first();

            $job_title1_arabic  = Setting::where('key','job_title1_arabic')->first();
            $job_title2_arabic  = Setting::where('key','job_title2_arabic')->first();
            $job_title3_arabic  = Setting::where('key','job_title3_arabic')->first();
            $job_title4_arabic  = Setting::where('key','job_title4_arabic')->first();

            $mobile  = Setting::where('key','mobile')->first();
            $hospital  = Setting::where('key','hospital')->first();
            $email  = Setting::where('key','email')->first();

        return view('admin.medical.medical_test',compact(['user','child','reservation','email','mobile','hospital','job_title4_arabic','job_title3_arabic','job_title2_arabic','job_title1_arabic','job_title4_english','job_title3_english','job_title2_english','job_title1_english','logo2','doctor_name_arabic','doctor_name_english','follow_up','color_create','color_edit','color_delete','color_main','color_second','logo','facebook','youtube','instagram','tiktok','clinc','tel','gallery','ios_link','android_link']));
    }


}
