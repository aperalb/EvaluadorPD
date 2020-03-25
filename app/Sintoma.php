<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sintoma extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'detalles',
        'categoriasintoma',
    ];

    public function paciente(){
        return $this->belongsTo('App\Paciente');
    }
}
