<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    //
    protected $fillable = [
        'valor',
        'tiporespuesta',
        'titulo',
        'enunciado',
        'rango',
        ];

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

