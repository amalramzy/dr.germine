<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Vaccination extends Model
{
    use HasFactory, HasTranslations;
    protected $appends = ['days'];

    protected $casts = [
        'days' => 'integer',
    ];

    protected $fillable = [
        'name',
        'day',
        'month',
        'year',
        'days'
    ];
    public $translatable = ['name'];

    public function getDaysAttribute(){
        $day=$this->day;
        $month = $this->month;
        $calmonth = $month * 30;
        $year = $this->year;
        $calyear = $year *365;
        $days = $day + $calmonth + $calyear;
        // dd($days);
        return $days;

    }

    public function reservations(){
        return $this->belongsToMany('App\Models\Reservation', 'vaccination_reservation');
    }
}
