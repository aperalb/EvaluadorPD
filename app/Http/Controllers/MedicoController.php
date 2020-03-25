<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Medico;

class MedicoController extends Controller
{
    public function index()
    {
        $medicos = Medico::get();
        return view('medico.index', ['medicos'=>$medicos]);
    }

    public function misPacientes()
    {
        $misPacientes = $this->pacientes();
        return view('paciente.index', ['pacientes'=>$misPacientes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('medicos/create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, []);

        //dd($request);
        //$request->add($medico);

        /** Creamos el nuevo paciente*/
        $paciente = new Paciente($request->all());
        $paciente->medico_id = Auth::user()->medico->id;
        //dd($paciente);
        $paciente->save();

        /** Sacamos mensaje flash */
        flash('Paciente creado correctamente');
        /** Volvemos al índice de los Pacientes*/
        return redirect()->route('paciente.index');

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
