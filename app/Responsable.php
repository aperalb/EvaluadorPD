<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Responsable extends Model
{
    protected $fillable = [
        'nombre',
        'apellido1',
        'apellido2',
        'numerotel',
        'direccion',
        'fotografia',
    ];

    //Relaciones
    //Un responsable tiene N pacientes
    public function pacientes(){
        return $this->belongsToMany('App\Paciente');
    }

    public function getParentesco($pacienteID,$responsable){

        $parentesco=DB::select('select parentesco from paciente_responsable where paciente_id = ? AND responsable_id=', [$pacienteID,$responsable->id]);
        return $parentesco;
    }

    public function getFullsurnameAttribute()
    {
        return $this->nombre.' '. $this->apellido1.' '.$this->apellido2;
    }
}

