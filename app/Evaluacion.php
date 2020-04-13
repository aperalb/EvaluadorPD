<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    protected $fillable = [
        'fechafin',
        'altura',
        'peso',
        'puntuacionglobal',

    ];
    //La evaluación pertenece a un paciente
    public function paciente()
    {
        return $this->belongsTo('App\Paciente');
    }
    //La evaluación tiene N formularios
    public function formularios()
    {
        return $this->belongsToMany('App\Formulario');
    }

    //La evaluación tiene N respuestas
    public function respuestas()
    {
        return $this->hasMany('App\Respuesta');
    }

    public  function esFinalizada(){
        return 1;
    }


}
