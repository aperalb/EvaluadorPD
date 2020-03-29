<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paciente;
use App\Tratamiento;

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
        $pacienteID=$request->get('pacienteID');
        $paciente = Paciente::find($pacienteID);
        $this->validate($request, []);

        /** Creamos el nuevo tratamiento*/
        $tratamiento = Tratamiento::create([
            'medicamento' => $request->get('medicamento'),
            'dosis' => $request->get('dosis'),
            'frecuencia' => $request->get('frecuencia'),
            'fechainicio' => $request->get('fechainicio'),
            'fechafin' => $request->get('fechafin'),
            'detalles' => $request->get('detalles'),
            'paciente_id' => $pacienteID
        ]);
        $tratamiento->save();

        return redirect('tratamiento/index/'.$pacienteID)->with('success', 'Elemento agregado correctamente');

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
        $tratamiento  = Tratamiento::find($id);
        return view('tratamiento/edit', ['tratamiento'=>$tratamiento] );
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
        return redirect($url)->with('success', 'Tratamiento editado con éxito.');    }

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
}
