<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Opening extends Model
{
    use HasFactory;
        // public $translatable = ['type'];

    protected $fillable = [
        'date',
        'time',
        'type',
        'clinc_id',
        'is_vacation'
    ];

    public function clinc(){
        return $this->belongsTo('App\Models\Clinc', 'clinc_id');
    }
}
