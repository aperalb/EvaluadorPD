<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

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

    public function getParentesco($pacienteID, $responsableID){

        $parentesco=DB::table('paciente_responsable')->where('paciente_id', $pacienteID)->where('responsable_id',$responsableID)->value('parentesco');
        return $parentesco;
    }

    public function getFullsurnameAttribute()
    {
        return $this->nombre.' '. $this->apellido1.' '.$this->apellido2;
    }
}

