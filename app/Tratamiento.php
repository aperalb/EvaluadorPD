<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tratamiento extends Model
{
    protected $fillable = [
        'medicamento',
        'dosis',
        'frecuencia',
        'fechainicio',
        'fechafin',
        'detalles',
        'paciente_id',

    ];

    public function paciente(){
        return $this->belongsTo('App\Paciente');
    }
}
