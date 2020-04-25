<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Formulario;
use App\Evaluacion;
use App\Pregunta;
use App\Respuesta;
use DB;
use App\User;
use Auth;

class FormularioController extends Controller
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
    public function create($idFormulario,$idEvaluacion)
    {
        User::validaRol('MEDICO');
        $evaluacion = Evaluacion::find($idEvaluacion);
        $formulario = Formulario::find($idFormulario);


        $preguntas = $formulario->preguntas;

        return view('formulario/create', ['evaluacion'=>$evaluacion, 'formulario'=>$formulario, 'preguntas'=>$preguntas]);

    }
//        dd($preguntas[1]);
        //
        // Traer preguntas asociadas a este formulario
        //
        //
        //RETURN Formulario, Evaluacion y Array de Preguntas.
//    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $idFormulario, $idEvaluacion)
    {
        User::validaRol('MEDICO');

        $evaluacion = Evaluacion::find($idEvaluacion);
        $formulario = Formulario::find($idFormulario);

        $existe=DB::table('evaluacion_formulario')->where('evaluacion_id', $idEvaluacion)->where('formulario_id',$idFormulario)->value('id');
        if($existe == ''){
            $evaluacion->formularios()->attach($formulario->id);

            $preguntas = $formulario->preguntas;
            foreach($preguntas as $pregunta){
                $respuestaValor = $request->get($pregunta->id);
                $respuesta = new Respuesta();
                $respuesta-> valor = $respuestaValor;
//                $respuesta-> respuestaposible = '';
//                $respuesta-> tipopregunta = '';
//                $respuesta-> enunciado = '';
                $respuesta-> pregunta_id = $pregunta->id;
                $respuesta->evaluacion_id = $evaluacion->id;
                $respuesta->save();
            }
        }else{
           return redirect('evaluacion/'.$idEvaluacion)->with('success', 'Este formulario ya ha sido completado');
        }
        return redirect('evaluacion/'.$idEvaluacion)->with('success', 'Elemento agregado correctamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $idFormulario, $idEvaluacion,$mensaje=null)
    {
        $evaluacion = Evaluacion::find($idEvaluacion);
        $formulario = Formulario::find($idFormulario);
        $preguntas=$formulario->preguntas;
        $idFormulariosPreguntas = [];
        foreach ($formulario->preguntas as $pregunta){
            array_push($idFormulariosPreguntas, $pregunta->id);
        }

        $respuestas=Respuesta::whereIn('pregunta_id',$idFormulariosPreguntas )->where('evaluacion_id',$evaluacion->id)->get();


        if($mensaje!=null){

            return view('formulario/show', ['evaluacion'=>$evaluacion, 'formulario'=>$formulario, 'preguntas'=>$preguntas, 'respuestas'=>$respuestas,'mensaje'=>$mensaje]);
        }
        else{
            return view('formulario/show', ['evaluacion'=>$evaluacion, 'formulario'=>$formulario, 'preguntas'=>$preguntas, 'respuestas'=>$respuestas]);
        }
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

    public function update(Request $request, $idFormulario,$idEvaluacion)
    {
//        User::validaRol('MEDICO');
        $evaluacion = Evaluacion::find($idEvaluacion);
        $formulario = Formulario::find($idFormulario);
        $idFormulariosPreguntas = [];

        foreach ($formulario->preguntas as $pregunta){
            array_push($idFormulariosPreguntas, $pregunta->id);
        }
        $respuestas=Respuesta::whereIn('pregunta_id',$idFormulariosPreguntas )->where('evaluacion_id',$evaluacion->id)->get();
//        dd($respuestas);
        foreach($respuestas as $respuesta){
            $respuestaValor = $request->get($respuesta->pregunta->id);
            $respuesta-> valor = $respuestaValor;
//            $respuesta-> respuestaposible = '';
//            $respuesta-> tipopregunta = '';
//            $respuesta-> enunciado = '';
            $respuesta->save();
        }
        $mensaje="Resolución editada correctamente";

        return $this->show($request, $idFormulario,$idEvaluacion,$mensaje);

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
