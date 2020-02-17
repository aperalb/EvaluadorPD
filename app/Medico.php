<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Medico extends Model
{

    protected $fillable = [
        'consulta',
        'numerotel',
        'especialidad',
    ];


    public static function findMedicoByUserId($userId)
    {
        $medico = Medico::where('user_id',$userId)->get();
        return($medico);
    }

    public function getMedicoId()
    {
        return $this->id;
    }
    //Relaciones
    //El medico corresponde a un User
    public function user(){
        return $this->belongsTo('App\User');
    }
    //El medico tiene N pacientes
    public function pacientes(){
        return $this->belongToMany('App\Paciente');
    }

}
