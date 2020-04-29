<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    protected $fillable = [
    'nombre',
    'descripcion',
        'categoria'
    ];

//    public function tratamientos(){
//        return $this->hasMany('App\Tratamiento');
//    }
}
