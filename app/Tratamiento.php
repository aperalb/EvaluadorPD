<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tratamiento extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'dosis',
        'frecuencia',
        'fechainicio',
        'fechafin',
        'detalles',
//        'paciente_id',
//        'medicamento_id'

    ];

    public function paciente(){
        return $this->belongsTo('App\Paciente');
    }

    public function medicamento(){
        return $this->belongsTo('App\Medicamento');
    }


}
