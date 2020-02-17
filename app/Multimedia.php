<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Multimedia extends Model
{
    //
    protected $fillable = [
        'nombre',
        'ruta',
        'tipomultimedia',

    ];

    //Relaciones
    //Los registros multimedia pertenecen a 1 Evaluacion.
    public function evaluacion()
    {
        return $this->belongsTo('App\Evaluacion');
    }
}
