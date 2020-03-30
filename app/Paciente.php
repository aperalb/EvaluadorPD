<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $fillable = [
        'nombre',
        'apellido1',
        'apellido2',
        'sexo',
        'nuhsa',
        'fechanac',
        'numerotel',
        'fechainiciopd',
        'observaciones',
    ];
    //Relaciones
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
    public function evaluacion(){
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

}
