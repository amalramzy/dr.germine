<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;


class Doctor extends Authenticatable implements HasMedia
{
    use HasFactory,InteractsWithMedia, HasTranslations;

    protected $guard = 'doctor';
    public $translatable = ['name'];
    protected $appends = ['documents'];
    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'bio'
    ];

    public function getDocumentsAttribute(){
        $media = $this->getMedia('documents');
        if(count($media) > 0){
            
            $documents = [];
            foreach($media as $document){
                array_push($documents,$document->getFullUrl());
            }
            return $documents;
        }
        return null;
    }
}
