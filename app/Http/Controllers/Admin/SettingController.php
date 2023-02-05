<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
class SettingController extends Controller
{
    public function index(Request $request)
    {
  
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

        return view('admin.setting.index',compact(['email','mobile','hospital','job_title4_arabic','job_title3_arabic','job_title2_arabic','job_title1_arabic','job_title4_english','job_title3_english','job_title2_english','job_title1_english','logo2','doctor_name_arabic','doctor_name_english','follow_up','color_create','color_edit','color_delete','color_main','color_second','logo','facebook','youtube','instagram','tiktok','clinc','tel','gallery','ios_link','android_link']));
    }
    public function store(Request $request)
    {
       Setting::where('key','follow_up_days')->update(['value'=>$request->follow_up_days]);
       Setting::where('key','color_create')->update(['value'=>$request->color_create]);
       Setting::where('key','color_edit')->update(['value'=>$request->color_edit]);
       Setting::where('key','color_delete')->update(['value'=>$request->color_delete]);
       Setting::where('key','color_main')->update(['value'=>$request->color_main]);
       Setting::where('key','color_second')->update(['value'=>$request->color_second]);
       Setting::where('key','facebook')->update(['value'=>$request->facebook]);
       Setting::where('key','youtube')->update(['value'=>$request->youtube]);
       Setting::where('key','instagram')->update(['value'=>$request->instagram]);
       Setting::where('key','tiktok')->update(['value'=>$request->tiktok]);
       Setting::where('key','clinc')->update(['value'=>$request->clinc]);
       Setting::where('key','tel')->update(['value'=>$request->tel]);
       Setting::where('key','ios_link')->update(['value'=>$request->ios_link]);
       Setting::where('key','android_link')->update(['value'=>$request->android_link]);
       Setting::where('key','doctor_name_english')->update(['value'=>$request->doctor_name_english]);
       Setting::where('key','doctor_name_arabic')->update(['value'=>$request->doctor_name_arabic]);
       Setting::where('key','job_title1_english')->update(['value'=>$request->job_title1_english]);
       Setting::where('key','job_title1_arabic')->update(['value'=>$request->job_title1_arabic]);
       Setting::where('key','job_title2_english')->update(['value'=>$request->job_title2_english]);
       Setting::where('key','job_title2_arabic')->update(['value'=>$request->job_title2_arabic]);
       Setting::where('key','job_title3_english')->update(['value'=>$request->job_title3_english]);
       Setting::where('key','job_title3_arabic')->update(['value'=>$request->job_title3_arabic]);
       Setting::where('key','job_title4_english')->update(['value'=>$request->job_title4_english]);
       Setting::where('key','job_title4_arabic')->update(['value'=>$request->job_title4_arabic]);
       Setting::where('key','mobile')->update(['value'=>$request->mobile]);
       Setting::where('key','hospital')->update(['value'=>$request->hospital]);
       Setting::where('key','email')->update(['value'=>$request->email]);

       $logo = Setting::where('key','logo')->first();
       if($logo){
        if ($request->hasFile('image')){
            $logo->clearMediaCollection('image');
            $logo->addMedia($request->file('image'))->toMediaCollection('image');
        }
       }
       $gallery = Setting::where('key','gallery')->first();
       if($gallery){
        if ($request->hasFile('photo')) {
            $gallery->clearMediaCollection('photos');
            $photos = $gallery->addMultipleMediaFromRequest(['photo'])
                ->each(function ($photos) {
                    $photos->toMediaCollection('photos');
                });
        }
       }
       $logo2 = Setting::where('key','logo2')->first();
       if($logo2){
        if ($request->hasFile('image2')){
            $logo2->clearMediaCollection('image2');
            $logo2->addMedia($request->file('image2'))->toMediaCollection('image2');
        }
       }
     
    return redirect()->route('setting.index');
    }
}
