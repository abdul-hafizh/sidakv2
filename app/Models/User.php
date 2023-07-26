<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use EloquentFilter\Filterable;
use App\Traits\Uuids;



class User extends Authenticatable implements JWTSubject
{
    use Notifiable,Uuids;
    use Filterable;

    // Rest omitted for brevity
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','username', 'email', 'password','phone','photo','status','status_province','created_by','remember_token',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function roleuser()
    {
        return $this->belongsTo('App\Models\RoleUser','user_id');
    }

    

    

    
}