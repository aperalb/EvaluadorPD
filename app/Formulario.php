<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Respuesta;
use App\Evaluacion;
use DB;

class Formulario extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'instrucción',
        'max',
    ];

    public function evaluacions()
    {
        return $this->belongsToMany('App\Evaluacion');
    }

    public function preguntas()
    {
        return $this->hasMany('App\Pregunta');
    }

    public static function numeroPreguntas($idFormulario)
    {
        $formulario = Formulario::find($idFormulario);
        $preguntas = $formulario->preguntas;
        $total = count($preguntas);
        return $total;

    }

    public function puntuacionObtenida($idEvaluacion, $idFormulario)
    {
        $evaluacion = Evaluacion::find($idEvaluacion);
        $formulario = Formulario::find($idFormulario);
        $preguntas=$formulario->preguntas;
        $idFormulariosPreguntas = [];
        foreach ($formulario->preguntas as $pregunta){
            array_push($idFormulariosPreguntas, $pregunta->id);
        }
        $respuestas=Respuesta::whereIn('pregunta_id',$idFormulariosPreguntas )->where('evaluacion_id',$evaluacion->id)->get();

        $puntuacion = 0;
        foreach ($respuestas as $res){
            $puntuacion = $puntuacion + ((double) $res->valor);
        }

        return $puntuacion;

    }
}
