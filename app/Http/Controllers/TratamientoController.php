<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Responsable;
use App\Paciente;
use App\Medico;
use App\Tratamiento;
use Redirect;
use App\User;

class TratamientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
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

        return view('tratamiento/create', ['pacienteID'=>$pacienteID]);
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
        $id=$request->get('pacienteID');
        $paciente = Paciente::find($id);
        $this->validate($request, []);

        /** Creamos el nuevo paciente*/
        $tratamiento = new Tratamiento();
        $tratamiento->medicamento=$request->get('medicamento');
        $tratamiento->dosis=$request->get('dosis');
        $tratamiento->frecuencia=$request->get('frecuencia');
        $tratamiento->fechainicio = $request->get('fechainicio');
        $tratamiento->fechafin = $request->get('fechafin');
        $tratamiento->detalles = $request->get('detalles');
        $tratamiento->paciente_id = $id;
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
        return view('tratamiento/edit', ['tratamiento'=>$tratamiento]);
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
        $tratamiento = Tratamiento::find($id);
        $tratamiento->fill($request->all());
        $tratamiento->save();
        $url=$request->input('url');
        return redirect($url)->with('success', 'Tratamiento editado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tratamiento = Tratamiento::find($id);
        $tratamiento->delete();
        return redirect()->back();
        //
    }

    public function __construct()
    {
        $this->middleware('auth');
    }
}
