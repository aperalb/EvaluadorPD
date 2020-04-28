<?php

namespace App\Http\Controllers;

use App\Paciente;
use App\Evaluacion;
use App\Formulario;
use App\User;
use Auth;
use App\Medico;
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
        Paciente::compruebaPertenencia($id);
        $paciente = Paciente::find($id);
        $evaluaciones = $paciente->evaluaciones;
        return view('evaluacion.index', ['evaluaciones'=>$evaluaciones, 'paciente'=>$paciente]);
    }

    public function index2()
    {
        User::validaRol('MEDICO');
        $idMedico = Auth::user()->medico->id;
        $medico = Medico::find($idMedico);
        $pacientes = $medico->pacientes;

        $evaluaciones = [];
        foreach ($pacientes as $p){
            $evaluacionesPaciente = $p->evaluaciones;
            foreach($evaluacionesPaciente as $ep){
                array_push($evaluaciones, $ep);

            }
        }

        return view('evaluacion/indexMisEvaluaciones', ['evaluaciones'=>$evaluaciones]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        User::validaRol('MEDICO');
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
        User::validaRol('MEDICO');
        $pacienteID=$request->get('pacienteID');
        $paciente = Paciente::find($pacienteID);
        $this->validate($request, []);

        /** Creamos el nuevo tratamiento*/
        $evaluacion = new Evaluacion();
        $evaluacion->fechafin=$request->get('fechafin');
        $evaluacion->altura=$request->get('altura');
        $evaluacion->peso = $request->get('peso');
        $evaluacion->descripcion = $request->get('descripcion');
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
        Paciente::compruebaPertenencia($evaluacion->paciente_id);
        $idFormulariosRealizados=DB::table('evaluacion_formulario')->where('evaluacion_id', $evaluacion->id)->get('formulario_id');
        $IdsFormulariosRealizados=[];
        $formulariosRealizados=[];
        foreach ($idFormulariosRealizados as $formularioID){
            $buscaID=($formularioID->formulario_id);
            array_push($IdsFormulariosRealizados,$buscaID);
            $formularioTemp=Formulario::find($buscaID);
            array_push($formulariosRealizados,$formularioTemp);
        }
        $formulariosNoRealizados=DB::table('formularios')->whereNotIn('id',$IdsFormulariosRealizados )->get();


        return view('evaluacion.show', ['evaluacion'=>$evaluacion, 'formulariosRealizados'=>$formulariosRealizados, 'formulariosNorealizados'=>$formulariosNoRealizados]);
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
        $evaluacion = Evaluacion::find($id);
        $evaluacion->fill($request->all());
        $evaluacion->save();
        return redirect('evaluacion/'.$evaluacion->id)->with('success', 'Elemento editado correctamente');
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
        $evaluacion = Evaluacion::find($id);
        $pacienteID = $evaluacion->paciente->id;
        $evaluacion->delete();
        return $this->index($pacienteID);
    }

    public function __construct()
    {
        $this->middleware('auth');
    }
}
