<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Slot extends Model
{
    use HasFactory;
// 'date'=> date("l d-m-Y", strtotime($request->date)),
// 'from'=>date('h:i a', strtotime($request->from)),
// 'to'=>date('h:i a', strtotime($request->to)),

    // public $translatable = ['date'];
    // protected $appends = ['full-date','day'];

    protected $fillable = [
        'date',
        'number',
        'from',
        'to',
        'reserved',
        'clinc_id'

    ];

    protected $appends = ['is-full'];
    public function getIsFullAttribute(){
        return $this->number == $this->reserved;
    }


    public function scopeFull($query)
    {
        $query->whereRaw('number = reserved ');
    }

    public function scopeFree($query)
    {
        $query->whereRaw('reserved < number');
    }

    public function clinc(){
        return $this->belongsTo('App\Models\Clinc', 'clinc_id');
    }


    public function reservations(){
        return $this->hasMany(Reservation::class,'slot_id');
    }
    public function repReservations(){
        return $this->hasMany(Represervation::class,'slot_id');
    }
}
