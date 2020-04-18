<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    //
    protected $fillable = [
        'valor',
//        'respuestaposible',
//        'tipopregunta',
//        'enunciado',
    ];

    //Una respuesta corresonde a 1 pregunta
    public function pregunta()
    {
        return $this->belongsTo('App\Pregunta');
    }
//    Una respuesta corresponde a 1 evaluación
    public function evaluacion()
    {
        return $this->hasOne('App\Evaluacion');
    }
    //Una respuesta puede tener 1..0 respuestas posibles
    public function respuestaposibles(){
        return $this->belongsTo('App\RespuestaPosible');
    }


}
