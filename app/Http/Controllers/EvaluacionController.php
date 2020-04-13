<?php

namespace App\Http\Controllers;

use App\Paciente;
use App\Evaluacion;
use DB;


use Illuminate\Http\Request;

class EvaluacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
//        dd($id);
        $paciente = Paciente::find($id);
        $evaluaciones = $paciente->evaluaciones;
        return view('evaluacion.index', ['evaluaciones'=>$evaluaciones, 'paciente'=>$paciente]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $pacienteID = $request->get('pacienteID');
        return view('evaluacion/create', ['pacienteID'=>$pacienteID]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pacienteID=$request->get('pacienteID');
        $paciente = Paciente::find($pacienteID);
        $this->validate($request, []);

        /** Creamos el nuevo tratamiento*/
        $evaluacion = new Evaluacion();
        $evaluacion->fechafin=$request->get('fechafin');
        $evaluacion->altura=$request->get('altura');
        $evaluacion->peso = $request->get('peso');
        $evaluacion->puntuacionglobal = $request->get('puntuacionglobal');
        $evaluacion->paciente_id = $pacienteID;
        $evaluacion->save();

        return redirect('evaluacion/index/'.$pacienteID)->with('success', 'Elemento agregado correctamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $evaluacion = Evaluacion::find($id);
        $formularios=DB::table('formularios')->get();
        return view('evaluacion.show', ['evaluacion'=>$evaluacion,'formularios'=>$formularios]);    }

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
