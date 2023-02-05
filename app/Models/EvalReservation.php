<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvalReservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_id',
        "evaluation_id",
        "score"
    ];
}
