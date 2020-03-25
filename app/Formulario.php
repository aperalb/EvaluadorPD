<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formulario extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'instrucción',
        'puntuacionglobal',
    ];

    public function evaluacions()
    {
        return $this->belongsToMany('App\Evaluacion');
    }

    public function preguntas()
    {
        return $this->belongsToMany('App\Pregunta');
    }
}
