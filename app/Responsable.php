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
    ];

    //Relaciones
    //Un responsable tiene N pacientes
    public function pacientes(){
        return $this->belongsToMany('App\Paciente');
    }
}

