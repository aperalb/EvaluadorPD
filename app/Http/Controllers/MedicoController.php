<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Medico;
use App\User;

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
        $user = User::find($id);
        return view('medico/edit', ['user'=>$user] );
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
//        dd($request);
        $user = User::find($id);
        $medico = $user->medico;
        $user->fill($request->all());
        $user->save();
        $medico->fill($request->all());
        $medico->save();

//        $user ->name = $request->get('name');
//        $user ->apellido1 = $request->get('apellido1');
//        $user ->apellido2 = $request->get('apellido2');
//        $user ->email = $request->get('email');
//        $user ->update();
//
//        $medico->numerotel = $request->get('numerotel');
//        $medico->consulta = $request->get('consulta');
//        $medico->especialidad = $request->get('especialidad');
//        $medico->fotografia = $request->get('fotografia');

//        $medico->update();

        return redirect()->route('home');


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

    public function __construct()
    {
        $this->middleware('auth');
    }
}
