<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Represervation extends Model
{
    use HasFactory;
    protected $fillable = [
        'salePerson_id',
        'type',
        'slot_id',
        'slot_order',
        'special_datetime',
        'comment',
       'doctor_comment',
       'secretarial_comment',
       'status',
       'arrive_time',
       'enter_time',
       'finish_time',
    ];

    public function salePerson(){
        return $this->belongsTo('App\Models\SalePerson', 'salePerson_id');
    }

    public function slots(){
        return $this->belongsTo(Slot::class, 'slot_id');
    }
}
