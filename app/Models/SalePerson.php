<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Notify;

class SalePerson extends Authenticatable implements HasMedia
{
    use HasFactory,InteractsWithMedia,HasApiTokens,Notifiable;
    protected $appends = ['image'];
    protected $fillable = [
        'name',
        'company',
        'email',
        'phone',
        'password',
        "notification_token"

    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getImageAttribute(){
        $url = $this->getFirstMediaUrl('image');
        return $url == "" ? null : $url;
    }

    public function repReservations(){
        return $this->hasMany('App\Models\Represervation','salePerson_id');
    }
    public function repReservationsReq(){
        return $this->hasMany('App\Models\MedicalRepRequests','medical_rep_id');
    }

    public function notifications()
    {
        return $this->morphMany(Notify::class, 'notifiable');
    }
}
