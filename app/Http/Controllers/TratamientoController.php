<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Responsable;
use App\Paciente;
use App\Medico;
use App\Tratamiento;
use Illuminate\Validation\ValidationException;
use Redirect;
use App\User;
use App\Medicamento;

class TratamientoController extends Controller
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
        $tratamientos = $paciente->tratamientos;
        return view('tratamiento.index', ['tratamientos'=>$tratamientos, 'paciente'=>$paciente]);
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
        $medicamentos = Medicamento::all();
        $categorias = Medicamento::categorias();
        return view('tratamiento/create', ['pacienteID'=>$pacienteID, 'medicamentos'=>$medicamentos, 'categorias'=>$categorias]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request);
        User::validaRol('MEDICO');
        $id=$request->get('pacienteID');
        $paciente = Paciente::find($id);

        $validatedData =   $request->validate([
                'dosis' => 'required|numeric',
                'frecuencia' => 'required|numeric',
                'fechainicio' => 'required|date',
                'fechafin' => 'required|date',
                'detalles' => 'nullable',
                'medicamentoSelect' => 'required|exists:medicamentos,id'
            ]);





        /** Creamos el nuevo paciente*/
        $tratamiento = new Tratamiento();
        $tratamiento->dosis=$request->get('dosis');
        $tratamiento->frecuencia=$request->get('frecuencia');
        $tratamiento->fechainicio = $request->get('fechainicio');
        $tratamiento->fechafin = $request->get('fechafin');
        $tratamiento->detalles = $request->get('detalles');
        $tratamiento->paciente_id = $id;
        $tratamiento->medicamento_id = $request->get('medicamentoSelect');
        $tratamiento->save();

        /** Sacamos mensaje flash */
        /** Volvemos al índice de los Pacientes*/
        return redirect('tratamiento/index/'.$id)->with('success', 'Elemento agregado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tratamiento = Tratamiento::find($id);
        Paciente::compruebaPertenencia($tratamiento->paciente_id);
        return view('tratamiento.show', ['tratamiento'=>$tratamiento]);

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
        User::validaRol('MEDICO');
        $tratamiento  = Tratamiento::find($id);
        $medicamentos = Medicamento::all();
        $categorias = Medicamento::categorias();
        return view('tratamiento/edit', ['tratamiento'=>$tratamiento, 'medicamentos'=>$medicamentos, 'categorias'=>$categorias]);
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
        $validatedData =   $request->validate([
            'dosis' => 'required|numeric',
            'frecuencia' => 'required|numeric',
            'fechainicio' => 'required|date',
            'fechafin' => 'required|date',
            'detalles' => 'nullable',
            'medicamentoSelect' => 'required|exists:medicamentos,id'
        ]);
        $tratamiento = Tratamiento::find($id);
        $tratamiento->fill($request->all());
        $tratamiento->medicamento_id = $request->get('medicamentoSelect');
        $tratamiento->save();
        $url=$request->input('url');
        return redirect('tratamiento/index/'.$tratamiento->paciente_id)->with('success', 'Tratamiento editado con éxito.');
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
        $tratamiento = Tratamiento::find($id);
        $tratamiento->delete();
        return redirect()->back();

    }

    public function __construct()
    {
        $this->middleware('auth');
    }
}
