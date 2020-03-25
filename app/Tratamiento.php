<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tratamiento extends Model
{
    protected $fillable = [
        'medicamento',
        'dosis',
        'fechainicio',
        'fechafin',
        'detalles',

    ];

    public function paciente(){
        return $this->belongsTo('App\Paciente');
    }
}
