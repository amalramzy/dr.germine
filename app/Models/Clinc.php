<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinc extends Model
{
    use HasFactory;
    protected $fillable = [
       
        'name',
        'title',
        'location_url',
        
      
    ];

    public function openings(){
        return $this->hasMany('App\Models\Opening','clinc_id');
    }

    public function slots(){
        return $this->hasMany('App\Models\Slot','clinc_id');
    }
}
