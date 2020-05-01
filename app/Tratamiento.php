<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tratamiento extends Model
{
    public $timestamps = false;
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

//    public function medicamentos(){
//        return $this->belongsTo('App\Medicamento');
//    }


}
