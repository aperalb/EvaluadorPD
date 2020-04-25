<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(User::showRol() == 'PACIENTE'){
            $paciente = Auth::user()->paciente;
            return view('paciente.show', ['paciente'=>$paciente]);
        }else if(User::showRol() == 'RESPONSABLE'){
            $pacientes = Auth::user()->responsable->pacientes;
            return view('paciente.index', ['pacientes'=>$pacientes]);
        }

        User::validaRol('MEDICO');
        return view('home');
    }
}
