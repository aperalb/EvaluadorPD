<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Paciente;
use App\Medico;
use Flash;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medico = Medico::find(Auth::user()->medico->id);
        $pacientes = $medico->pacientes;

        return view('paciente.index', ['pacientes'=>$pacientes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('paciente/create');
    }

    public function store(Request $request)
    {
        $this->validate($request, []);

        /** Creamos el nuevo paciente*/
        $paciente = new Paciente($request->all());
        $paciente->save();
        $medico = Auth::user()->medico;
        $paciente->medicos()->attach($medico->id);

        /** Sacamos mensaje flash */
        /** Volvemos al índice de los Pacientes*/
        return redirect()->route('home')->with('success', 'Elemento agregado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paciente = Paciente::find($id);
        return view('paciente.show', ['paciente'=>$paciente]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paciente  = Paciente::find($id);
        return view('paciente/edit', ['paciente'=>$paciente] );


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $paciente = Paciente::find($id);
        $paciente->fill($request->all());
        $paciente->save();
        return redirect()->route('paciente.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $paciente = Paciente::find($id);
        $paciente->delete();
        return redirect()->route('paciente.index');
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

}
