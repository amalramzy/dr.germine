<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Child extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;
    protected $appends = ['image','day','child_tests','age'];
    protected $fillable = [
        'user_id',
        'name',
        'birthdate',
        'gender',
        'hospital',
        'weight',
        'height',
        'head_size',
        'temperature'

    ];

    public function getDayAttribute(){
        $today = date("y-m-d");
        $calc = date_diff(date_create($this->birthdate), date_create($today));

        $day  = $calc->format('%a day');
        return $day;
    }


    public function getAgeAttribute(){
        $bday = new DateTime($this->birthdate); // Your date of birth
        $today = new Datetime(date('y-m-d'));
        $diff = $today->diff($bday);
        return $diff;
    }
    public function getImageAttribute(){
        $url = $this->getFirstMediaUrl('image');
        return $url == "" ? null : $url;
    }

    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function reservations(){
        return $this->hasMany('App\Models\Reservation','child_id');
    }
    public function vaccinations(){
        return $this->belongsToMany(Vaccination::class, 'child_vaccinations');
    }

    public function getChildTestsAttribute(){
        $media = $this->getMedia('child_tests');
//        if(count($media) > 0){
//
//            $child_tests = [];
//            foreach($media as $child_test){
//                array_push($child_tests,$child_test->getFullUrl());
//            }
//            return $child_tests;
//        }
        return $media;
    }

    public function availableFollowUps(){
        $this->hasMany(AvailableFollowUp::class,'child_id','id');
    }
    public function isTheirParent($parent){
        return $this->user_id == $parent->id;
    }

    public function availableVaccines(){
        $child = $this;

        $childDay = $child->age->d;
        $childYear = $child->age->y;
        $childMonth = $child->age->m;

        $childVacIds=ChildVaccination::where("child_id",$child)->pluck('vaccination_id');
        $res = Vaccination::where([
            "year"=>$childYear,
            "day"=>$childDay,
            "month"=>$childMonth
        ])->whereNotIn('id',$childVacIds)->get();
        return $res;
    }
}
