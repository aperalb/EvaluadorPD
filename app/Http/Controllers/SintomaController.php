<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sintoma;
use App\Paciente;

class SintomaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $paciente = Paciente::find($id);
        $sintomas = $paciente->sintomas;
        return view('sintoma.index', ['sintomas'=>$sintomas, 'paciente'=>$paciente]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $pacienteID = $request->get('pacienteID');
        return view('sintoma/create', ['pacienteID'=>$pacienteID]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $id=$request->get('pacienteID');
        $paciente = Paciente::find($id);
        $this->validate($request, []);

        /** Creamos el nuevo paciente*/
        $sintoma = new Sintoma();
        $idSintoma=$request->get('nombre');
        $valorSintoma=array_values(config('enumSintomas.Motores'))[$idSintoma];



        if (array_values(config('enumSintomas.Motores'))[$idSintoma]){

            $categoriasintoma="motores";
        }
        else{

            $categoriasintoma="nomotores";
        }
        $sintoma->nombre=$valorSintoma;
        $sintoma->categoriasintoma=$categoriasintoma;
        $sintoma->descripcion=$request->get('descripcion');
        $sintoma->detalles=$request->get('detalles');
        $sintoma->paciente_id = $id;
        $sintoma->save();

        /** Sacamos mensaje flash */
        /** Volvemos al índice de los Pacientes*/
        return redirect('sintoma/index/'.$id)->with('success', 'Elemento agregado correctamente');
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
