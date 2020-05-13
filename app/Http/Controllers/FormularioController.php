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

class FormularioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // METODOS PARA CRUD DE RESOLUCIONES DE FORMULARIOS

    public function index()
    {
        User::validaRol('MEDICO');
        $formularios = Formulario::all();
        return view('formulario/index', ['formularios'=>$formularios]);
    }

    public function create($idFormulario,$idEvaluacion)
    {
        User::validaRol('MEDICO');
        $evaluacion = Evaluacion::find($idEvaluacion);
        $formulario = Formulario::find($idFormulario);


        $preguntas = $formulario->preguntas;

        return view('formulario/create', ['evaluacion'=>$evaluacion, 'formulario'=>$formulario, 'preguntas'=>$preguntas]);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // Crear una resolucion
    public function store(Request $request, $idFormulario, $idEvaluacion)
    {
        User::validaRol('MEDICO');

        $evaluacion = Evaluacion::find($idEvaluacion);
        $formulario = Formulario::find($idFormulario);

        $existe=DB::table('evaluacion_formulario')->where('evaluacion_id', $idEvaluacion)->where('formulario_id',$idFormulario)->value('id');
        if($existe == ''){
            $preguntas = $formulario->preguntas;
            foreach($preguntas as $pregunta){

                $respuestaValor = $request->get($pregunta->id);
                $respuesta = new Respuesta();
                $respuesta-> valor = $respuestaValor;
                $respuesta-> pregunta_id = $pregunta->id;
                $respuesta->evaluacion_id = $evaluacion->id;
                $respuesta->save();
            }
            $evaluacion->formularios()->attach($formulario->id);

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
        Paciente::compruebaPertenencia($evaluacion->paciente_id);
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






    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //Update de una resolucion
    public function update(Request $request, $idFormulario,$idEvaluacion)
    {
        User::validaRol('MEDICO');
        $evaluacion = Evaluacion::find($idEvaluacion);
        $formulario = Formulario::find($idFormulario);
        $idFormulariosPreguntas = [];

        foreach ($formulario->preguntas as $pregunta){
            array_push($idFormulariosPreguntas, $pregunta->id);
        }
        $respuestas=Respuesta::whereIn('pregunta_id',$idFormulariosPreguntas )->where('evaluacion_id',$evaluacion->id)->get();
        foreach($respuestas as $respuesta){
            $respuestaValor = $request->get($respuesta->pregunta->id);
            $respuesta-> valor = $respuestaValor;
            $respuesta->save();
        }
        $mensaje="Resolución editada correctamente";

        return $this->show($request, $idFormulario,$idEvaluacion,$mensaje);

    }


    // METODOS PARA CRUD DE FORMULARIOS
    public function showList(Request $request, $idFormulario)
    {

        User::validaRol('MEDICO');
        $formulario = Formulario::find($idFormulario);
        $preguntas=$formulario->preguntas;
        return view('formulario/showList', ['formulario'=>$formulario, 'preguntas'=>$preguntas]);

    }

    // Este metodo da el alta a un neuvo formularios
    public function altaFormulario(Request $request){
        User::validaRol('MEDICO');
        $validatedData = $request->validate([
            'nombre' => 'required|alpha_num',
        ]);
        $formulario = new Formulario();
        $formulario->nombre = $request->get('nombre');
        $formulario->descripcion = $request->get('descripcion');
        $formulario->max=0;
        $formulario->save();

        return redirect('/formulario/index')->with('success', 'Elemento añadido correctamente');

    }
       // Este metodo permite añadir preguntas (una a una).
    public function edit(Request $request, $idFormulario){
        User::validaRol('MEDICO');
        if(Formulario::formularioEnUso($idFormulario) == false) {
            return redirect('/formulario/showList/' . $idFormulario)->with('danger', 'No puede editar un formulario que está en uso en alguna evaluación');
        }

        $formulario = Formulario::find($idFormulario);
        $validatedData = $request->validate([
            'tituloCreate' => 'required',
            'enunciadoCreate' => 'required',
            'rangoCreate' => 'required|integer',

        ]);
        $pregunta = new Pregunta();
        $pregunta->titulo = $request->get('tituloCreate');
        $pregunta->enunciado = $request->get('enuncuadoCreate');
        $pregunta->tiporespuesta = 'numerico';
        $pregunta->rango =  '0-'.$request->get('rangoCreate');
        $pregunta->formulario_id = $idFormulario;
        $pregunta->save();
        $formulario->max = Formulario::actualizaMaxPuntacion($idFormulario);
        $formulario->save();

        return redirect('/formulario/showList/'.$idFormulario);

    }

        // Elimina un formulario
    public function destroy($idFormulario)
    {
        User::validaRol('MEDICO');
        if(Formulario::formularioEnUso($idFormulario) == false) {
            return redirect('/formulario/showList/' . $idFormulario)->with('danger', 'No puede editar un formulario que está en uso en alguna evaluación');
        }
        $formulario = Formulario::find($idFormulario);
        $formulario->delete();
        return redirect('/formulario/index')->with('danger', 'Elemento eliminado correctamente');

    }


}
