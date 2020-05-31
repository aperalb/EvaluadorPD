<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Medico;
use App\User;
use Illuminate\Validation\Rule;
use App\Paciente;
use App\Evaluacion;
use App\Formulario;
use Auth;
use DB;
use App\Respuesta;
use App\Sintoma;
use App\Charts\EvolucionPacienteFormulario;

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
        User::validaRol('MEDICO');

        $validatedData = $request->validate([
            'name' => 'required|alpha',
            'apellido1'=>'required|alpha',
            'apellido2'=>'required|alpha',
            'email'=>['required','email:rfc', Rule::unique('users')->ignore($id)],
            'numerotel'=> 'required|alpha_num|max:9',
            'fotografia' => 'nullable|mimes:jpeg,bmp,png',
            'consulta' => 'required',
            'especialidad' => 'required'
        ]);
        $user = User::find($id);
        $medico = $user->medico;
        $user->fill($request->all());
        if($request->hasFile('fotografia')){
            try {
                $user->getMedia('fotografias')[0]->delete();
            }catch(\Exception $e){
                // Si no puede eliminar, que incluya la nueva imagen y punto.
            }
            $user->addMediaFromRequest('fotografia')->toMediaCollection('fotografias');
        }
        $user->save();
        $medico->fill($request->all());
        $medico->save();

        return redirect()->route('home')->with('success', 'Los datos han sido editados con éxito');


    }


    public function destroy($id)
    {
        //
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function Estadisticas()
    {
        User::validaRol('MEDICO');
        // Numero de pacipentes:
        $pacientes = Paciente::all();
        $edades=[];
        $anosInicioPD = [];

        $numH = 0;
        $numM = 0;
        $evaluaciones = DB::table('evaluacions')->whereNotNull('fechafin')->get();
        $sintomas=Sintoma::all();

        $graficas=[];

        foreach ($pacientes as $paciente){
            array_push($edades,$paciente->getAgeAttribute());
            array_push($anosInicioPD,$paciente->getInitPDAgeAttribute());
            if($paciente->sexo == 'Hombre'){
                $numH =  $numH + 1;
            }else{
                $numM = $numM + 1;
            }

        }

        $mediaPuntuacionFormularios = array();


        foreach ($evaluaciones as $evaluacionGet) {

            $evaluacion = Evaluacion::find($evaluacionGet->id);

            $formulariosRealizados = $evaluacion->formularios;

            foreach ($formulariosRealizados as $form) {
                if (array_key_exists($form->nombre, $mediaPuntuacionFormularios)) {
                    array_push($mediaPuntuacionFormularios[$form->nombre], $form->puntuacionObtenida($evaluacion->id, $form->id));
                } else {
                    $mediaPuntuacionFormularios[$form->nombre] = array( $form->puntuacionObtenida($evaluacion->id, $form->id));
                }
            }
        }

        foreach (array_keys($mediaPuntuacionFormularios) as $form) {
            $mediaPuntuacionFormularios[$form]=array_sum($mediaPuntuacionFormularios[$form])/count($mediaPuntuacionFormularios[$form]);


        }


        $categoriaYSintomas=[];
        foreach ($sintomas as $sintoma){
            if(in_array($sintoma->categoriasintoma,array_keys($categoriaYSintomas))){
                array_push($categoriaYSintomas[$sintoma->categoriasintoma],$sintoma);
            }
            else{
                $categoriaYSintomas[$sintoma->categoriasintoma]=[$sintoma];
            }
        }

        foreach (array_keys($categoriaYSintomas) as $key){
            $categoriaYSintomas[$key] = count($categoriaYSintomas[$key]);
        }



        $numeroPacientes = sizeof($pacientes);
        $mediaEdad= array_sum($edades)/count($edades);
        $mediaEdadInitPD = array_sum($anosInicioPD)/count($anosInicioPD);
        $porcentajeH = ($numH/$numeroPacientes)*100;
        $porcentajeM = ($numM/$numeroPacientes)*100;
        $numeroEvaluaciones=count($evaluaciones);

        $chartSexo = new EvolucionPacienteFormulario;
        $dataset = [$porcentajeH, $porcentajeM ];
        $labelsSexo = ['Hombre', 'Mujer'];
        $coloursSexo=["rgba(".random_int(0,255).",".random_int(0,255).",".random_int(0,255).", 0.2)","rgba(".random_int(0,255).",".random_int(0,255).",".random_int(0,255).", 0.2)"];
        $chartSexo->labels($labelsSexo);
        $chartSexo->displayLegend(false);
        $chartSexo->dataset('Porcentaje Pacientes','bar', $dataset)->color($coloursSexo)->backgroundcolor($coloursSexo);
        $chartSexo ->title('Sexo de los pacientes');
        array_push($graficas, $chartSexo );


        $chartSintomas = new EvolucionPacienteFormulario;
        $dataset = array_values($categoriaYSintomas);
        $labelsSintomas = array_keys($categoriaYSintomas);
        $coloursSintomas=["rgba(".random_int(0,255).",".random_int(0,255).",".random_int(0,255).", 0.2)","rgba(".random_int(0,255).",".random_int(0,255).",".random_int(0,255).", 0.2)","rgba(".random_int(0,255).",".random_int(0,255).",".random_int(0,255).", 0.2)","rgba(".random_int(0,255).",".random_int(0,255).",".random_int(0,255).", 0.2)","rgba(".random_int(0,255).",".random_int(0,255).",".random_int(0,255).", 0.2)","rgba(".random_int(0,255).",".random_int(0,255).",".random_int(0,255).", 0.2)","rgba(".random_int(0,255).",".random_int(0,255).",".random_int(0,255).", 0.2)","rgba(".random_int(0,255).",".random_int(0,255).",".random_int(0,255).", 0.2)","rgba(".random_int(0,255).",".random_int(0,255).",".random_int(0,255).", 0.2)"];
        $chartSintomas->labels($labelsSintomas);
        $chartSintomas->displayLegend(false);
        $chartSintomas->dataset('Número Síntomas','bar', $dataset)->color($coloursSintomas)->backgroundcolor($coloursSintomas);
        $chartSintomas ->title('Categorias de los sintomas e incidencia en pacientes');
        array_push($graficas, $chartSintomas );


        $chartFormularios = new EvolucionPacienteFormulario;
        $dataset = array_values($mediaPuntuacionFormularios);
        $labelsFormularios = array_keys($mediaPuntuacionFormularios);
        $coloursFormularios=["rgba(".random_int(0,255).",".random_int(0,255).",".random_int(0,255).", 0.2)","rgba(".random_int(0,255).",".random_int(0,255).",".random_int(0,255).", 0.2)","rgba(".random_int(0,255).",".random_int(0,255).",".random_int(0,255).", 0.2)","rgba(".random_int(0,255).",".random_int(0,255).",".random_int(0,255).", 0.2)","rgba(".random_int(0,255).",".random_int(0,255).",".random_int(0,255).", 0.2)","rgba(".random_int(0,255).",".random_int(0,255).",".random_int(0,255).", 0.2)","rgba(".random_int(0,255).",".random_int(0,255).",".random_int(0,255).", 0.2)","rgba(".random_int(0,255).",".random_int(0,255).",".random_int(0,255).", 0.2)","rgba(".random_int(0,255).",".random_int(0,255).",".random_int(0,255).", 0.2)"];
        $chartFormularios->labels($labelsFormularios);
        $chartFormularios->displayLegend(false);
        $chartFormularios->dataset('Media Puntuación','bar', $dataset)->color($coloursFormularios)->backgroundcolor($coloursFormularios);
        $chartFormularios ->title('Media Puntuación Formularios');
        array_push($graficas, $chartFormularios );


        return view('medico/estadisticas', ['numeroPacientes' => $numeroPacientes,'mediaEdad'=>$mediaEdad,
            'mediaEdadInitiPD'=>$mediaEdadInitPD,'numeroEvaluaciones'=>$numeroEvaluaciones,'graficas'=>$graficas]);
    }

}
