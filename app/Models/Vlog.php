<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Vlog extends Model implements HasMedia
{
    use HasFactory, HasTranslations, InteractsWithMedia;
    protected $appends = ['video'];

    protected $fillable = [
        'title',
        'content'
    ];
    public $translatable = ['title','content'];

    
    public function getVideoAttribute(){
        $url = $this->getFirstMediaUrl('video');
        return $url == "" ? null : $url;
    }
}
