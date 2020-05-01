<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;


class Medicamento extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'nombre',
        'categoria',
        'descripcion',

    ];


//    public function tratamientos(){
//        return $this->hasMany('App\Tratamiento');
//    }

    public static function categorias(){
        $categorias=DB::table('medicamentos')->groupBy('categoria')->orderBy('categoria')->pluck('categoria');
        return $categorias->all();
    }

    






}
