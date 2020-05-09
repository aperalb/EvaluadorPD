<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

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

    public static function compruebaSintomaExiste($nombreSintoma,$pacienteID){
        {
            $res = false;
            $numResultados=DB::table('sintomas')->where('paciente_id', $pacienteID)->where('nombre',$nombreSintoma)->count();

            if($numResultados> 0){
                $res = true;
            }
            return  $res;
        }
    }
}
