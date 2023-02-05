<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens;
use Laravel\Passport\HasApiTokens;
use App\Models\Notify;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $appends = ['image'];
    protected $fillable = [
        'father',
        'mother',
        'email',
        'area_id',
        'phone1',
        'phone2',
        'password',
        'block',
        'notification_token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function children(){
        return $this->belongsTo('App\Models\Child','user_id');
    }

    public function getImageAttribute(){
        $url = $this->getFirstMediaUrl('image');
        return $url == "" ? null : $url;
    }

    public function notifications()
    {
        return $this->morphMany(Notify::class, 'notifiable');
    }

    public function area(){
        return $this->belongsTo('App\Models\Area', 'area_id');
    }
}


