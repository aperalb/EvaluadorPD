<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Formulario;
use App\Evaluacion;
use App\Pregunta;
use App\Respuesta;
use App\Paciente;
use DB;
use App\User;
use Auth;

class PreguntaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        User::validaRol('MEDICO');
        $pregunta = Pregunta::find($id);

        if(Formulario::formularioEnUso($pregunta->formulario_id) == false) {
            return redirect('/formulario/showList/' . $pregunta->formulario_id)->with('danger', 'No puede editar un formulario que está en uso en alguna evaluación');
        }
        $pregunta->titulo = $request->get('tituloCreate');
        $pregunta->enunciado = $request->get('enunciadoCreate');
        $pregunta->rango = '0-'.$request->get('rangoCreate');
        $pregunta->save();
        $formulario = Formulario::find($pregunta->formulario_id);
        $formulario->max = Formulario::actualizaMaxPuntacion($formulario->id);
        $formulario->save();

        return redirect('/formulario/showList/'.$pregunta->formulario_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::validaRol('MEDICO');
        $pregunta = Pregunta::find($id);
        $idFormulario = $pregunta->formulario_id;
        $formulario = $pregunta->formulario;

        if(Formulario::formularioEnUso($pregunta->formulario_id) == false) {
            return redirect('/formulario/showList/' . $pregunta->formulario_id)->with('danger', 'No puede editar un formulario que está en uso en alguna evaluación');
        }
        $pregunta->delete();
        $formulario->max = Formulario::actualizaMaxPuntacion($idFormulario);
        $formulario->save();
        return redirect()->back()->with('danger', 'Pregunta eliminada con éxito.');
        //
    }
}
