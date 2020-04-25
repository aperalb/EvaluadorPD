<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Auth;

use App\Medico;

class User extends Authenticatable implements HasMedia
{
    use Notifiable;
    use HasMediaTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'apellido1',
        'apellido2',
        'rol',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getFullsurnameAttribute()
    {
        return $this->name.' '. $this->apellido1.' '.$this->apellido2;

    }

    public static function showRol(){
        return Auth::user()->rol;
    }

    public static function validaRol($rol){
        if(Auth::user()->rol != $rol){
            return abort(401, "No tiene permiso para acceder a esta información.");
        }

    }


    //Relaciones
    public function Medico(){
        return $this->hasOne('App\Medico');
    }
    public function Paciente(){
        return $this->hasOne('App\Paciente');
    }

    public function Responsable(){
        return $this->hasOne('App\Responsable');
    }





}
