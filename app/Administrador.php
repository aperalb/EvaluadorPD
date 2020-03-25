<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    protected $fillable = [
        // pues parece que no tiene nada
    ];

    //Relaciones
    public function user(){
        return $this->belongsTo('App\User');
    }
}
