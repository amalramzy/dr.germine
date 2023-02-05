<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRepRequests extends Model
{
    use HasFactory;
    protected $fillable = ['medical_rep_id','slot_id','comment'
    ,'secretary_comment','status','special_datetime'

    ];
    public function medicalRep(){
        return $this->belongsTo(SalePerson::class,'medical_rep_id');
    }

    public function slot(){
        return $this->belongsTo(Slot::class,'slot_id');
    }
}
