<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Reservation extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'child_id',
        'type',
        'slot_id',
        'slot_order',
        'special_datetime',
       'patient_comment',
       'secretarial_comment',
       'status',
       'arrive_time',
       'enter_time',
       'finish_time',
        'weight',
        'height',
        'head_size',
        'temperature',
        'is_follow_up'
        ,'doctor_comment','doctor_notes','price','parent_id'

    ];

    public function child(){
        return $this->belongsTo('App\Models\Child', 'child_id');
    }

    public function vaccinations(){
        return $this->belongsToMany('App\Models\Vaccination', 'vaccination_reservation');
    }

    public function diagnostics()
    {
        return $this->morphedByMany(Diagnostic::class,'reservable','reservation_data','reservation_id' );
    }
    public function medicalTests()
    {
        return $this->morphedByMany(Medicaltest::class,'reservable','reservation_data','reservation_id' );
    }

    public function medicines()
    {
        return $this->morphedByMany(Medicine::class,'reservable','reservation_data','reservation_id' )->withPivot('period','dose_id','notes','alt_medicine_id');
    }

    public function actualVaccinations()
    {
        return $this->morphedByMany(Vaccination::class,'reservable','reservation_data','reservation_id' );
    }
    public function evals(){
        return $this->belongsToMany(Evaluation::class,'eval_reservations');
    }

    public static function extraInfo($reserv){
        $reserv['vaccinations']=$reserv->vaccinations->each(function($item){
            return $item['name'];
        });
        $reserv['diagnostics']=$reserv->diagnostics;
        $reserv['medicalTests']=$reserv->medicalTests;
        $reserv['medicines']=$reserv->medicines;
        $reserv['actualVaccinations']=$reserv->actualVaccinations;

        return $reserv;
    }
}
