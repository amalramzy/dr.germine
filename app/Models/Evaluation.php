<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Evaluation extends Model
{
    use HasFactory, HasTranslations;

    protected $appends = ['score'];


    protected $fillable = [
        'question'
    ];
    public $translatable = ['question'];

    public function getScoreAttribute(){
        $scores = EvalReservation::where('evaluation_id',$this->id)->pluck('score')->toArray();
        $average = array_sum($scores)/count($scores);
        return round($average, 2);
    }

    public function reservations(){
        return $this->belongsToMany(Reservation::class,'eval_reservations');
    }
}
