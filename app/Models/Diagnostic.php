<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Diagnostic extends Model implements HasMedia
{
    use HasFactory, HasTranslations,InteractsWithMedia;

    protected $fillable = [
        'name'
    ];
    public $translatable = ['name'];
}
