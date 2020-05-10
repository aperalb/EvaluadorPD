<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Auth;

class Paciente extends Model
{
    protected $fillable = [
//        'nombre',
//        'apellido1',
//        'apellido2',
        'sexo',
        'nuhsa',
        'fechanac',
        'numerotel',
        'direccion',
        'fechainiciopd',
        'observaciones',
    ];



    //Relaciones
    // Un paciente pertenece a un
    public function user(){
        return $this->belongsTo('App\User');
    }
    //Un paciente tiene N responsables
    public function responsables(){
        return $this->belongsToMany('App\Responsable');
    }
    //Un paciente tiene N medicos
    public function medicos(){
        return $this->belongsToMany('App\Medico');
    }
    //Un paciente presenta N sintomas
    public function sintomas(){
        return $this->hasMany('App\Sintoma');
    }
    //Un paciente presenta N tratamientos
    public function tratamientos(){
        return $this->hasMany('App\Tratamiento');
    }
    //Un paciente tiene N evaluaciones
    public function evaluaciones(){
        return $this->hasMany('App\Evaluacion');
    }

    //Otras funciones
    public function getAgeAttribute(){
        $sysDate = date('Y');
        $anoNac = date('Y', strtotime($this->fechanac));
        return $sysDate - $anoNac;
    }

    public function getAgeInitPD()
    {
        return date('Y', strtotime($this->fechainiciopd));
    }

    public function getFullsurnameAttribute()
    {
        return $this->nombre.' '. $this->apellido1.' '.$this->apellido2;
    }

    public static function compruebaPertenencia($id)
    {
        $rolLogueado = User::showRol();
        if($rolLogueado == 'PACIENTE'){
            if(Auth::user()->paciente->id != $id){

                abort(401, "No tiene permiso para acceder a esta página");
            }
        }else if($rolLogueado == 'RESPONSABLE'){
            $pacientes = (Auth::user()->responsable->pacientes);

            $paciente = Paciente::find($id);
            if(!$pacientes->contains($paciente)){
                abort(401, "No tiene permiso para acceder a esta página");
            }


        }

    }

}
