<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RespuestaPosible extends Model
{
    //
    protected $fillable = ['enunciado'];

    //Relaciones
    //Varias respuestas posibles pueden pertenecer a 1 pregunta
    public function preguntas(){
        return $this->belongsTo('App\Pregunta');
    }

    //Una respuesta posible puede estar vinculada a 0..1 respuesta
    public function respuesta(){
        return $this->hasOne('App\Respuesta');
    }

}
