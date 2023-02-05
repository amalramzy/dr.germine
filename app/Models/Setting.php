<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
class Setting extends Model implements HasMedia
{
    use HasFactory, HasTranslations,InteractsWithMedia;

    protected $fillable = [
        'name',
        'key',
        'value'
    ];
    public $translatable = ['name'];
    protected $appends = ['image','photos','image2'];

    public function getImageAttribute(){
        $url = $this->getFirstMediaUrl('image');
        return $url == "" ? null : $url;
    }

    public function getImage2Attribute(){
        $url = $this->getFirstMediaUrl('image2');
        return $url == "" ? null : $url;
    }

    public function getPhotosAttribute(){
        $media = $this->getMedia('photos');
        if(count($media) > 0){
            
            $photos = [];
            foreach($media as $photo){
                array_push($photos,$photo->getFullUrl());
            }
            return $photos;
        }
        return null;
    }

}
