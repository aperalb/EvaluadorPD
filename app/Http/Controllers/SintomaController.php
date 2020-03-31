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
        $valorSintoma=array_values(array_merge(config('enumSintomas.Motores'),config('enumSintomas.No_Motores')))[$idSintoma];



        if (in_array($valorSintoma,array_values(config('enumSintomas.Motores')))){

            $categoriasintoma="Motores";
        }
        else{

            $categoriasintoma="No motor";
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
        $sintoma  = Sintoma::find($id);
        return view('sintoma/edit', ['sintoma'=>$sintoma] );
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
        $sintoma = Tratamiento::find($id);
        $sintoma->fill($request->all());
        $sintoma->save();
        $url=$request->input('url');
        return redirect($url)->with('success', 'Sintoma editado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sintoma = Sintoma::find($id);
        $sintoma->delete();
        return redirect()->back();
        //
    }
}
