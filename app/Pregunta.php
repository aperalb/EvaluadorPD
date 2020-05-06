<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    //
    protected $fillable = [
        'tiporespuesta',
        'titulo',
        'enunciado',
        'rango',
    ];

    public function constructorPregunta($titulo, $enunciado, $rango, $formularioID)
    {
        $pregunta = new Pregunta();
        $pregunta->titulo = $titulo;
        $pregunta->enunciado = $enunciado;
        $pregunta->rango = '0-'.$rango;
        $pregunta->tiporespuesta = 'numerico';
        $pregunta->formulario_id = $formularioID;

        return $pregunta;
    }
    //Relaciones
    //Una pregunta pertenece a 1 formulario
    public function formulario()
    {
        return $this->belongsTo('App\Formulario');
    }

    //Una pregunta tiene N respuestas (texto plano)
    public function respuestas()
    {
        return $this->hasMany('App\Respuesta');
    }

    //Una pregunta tiene N respuestas (texto predefinido)
    //to-do
}

