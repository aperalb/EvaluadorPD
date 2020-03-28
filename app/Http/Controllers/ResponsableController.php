<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Responsable;
use App\Paciente;
use DB;

class ResponsableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $paciente = Paciente::find($id);
        $responsables = $paciente->responsables;
        return view('responsable.index', ['responsables'=>$responsables, 'paciente'=>$paciente]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $pacienteID = $request->get('pacienteID');
        return view('responsable/create', ['pacienteID'=>$pacienteID]);
    }


    public function store(Request $request)
    {

        $pacienteID=$request->get('pacienteID');
        $parentesco=$request->get('parentesco');
        $paciente = Paciente::find($pacienteID);
        $this->validate($request, []);

        /** Creamos el nuevo paciente*/
        $responsable = Responsable::create([
            'nombre' => $request->get('nombre'),
            'apellido1' => $request->get('apellido1'),
            'apellido2' => $request->get('apellido2'),
            'numerotel' => $request->get('numerotel'),
            'direccion' => $request->get('direccion')
            ]);
        $responsable->save();
        $responsable->pacientes()->attach($pacienteID, ['parentesco' => $parentesco]);
//        $responsable->pacientes()->attach($pacienteID);

        /** Sacamos mensaje flash */
        /** Volvemos al índice de los Pacientes*/
        return redirect('responsable/index/'.$pacienteID)->with('success', 'Elemento agregado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $responsables = Paciente::find($id)->responsables;
        return view('responsable.show', ['responsables'=>$responsables, 'pacienteid'=>$id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $responsable  = Responsable::find($id);

        return view('responsable/edit', ['responsable'=>$responsable] );

    }

    public function editar(Request $request)
    {
        $idResponsable=$request->get('responsableID');
        $pacienteID=$request->get('pacienteID');
        $responsable  = Responsable::find($idResponsable);
        $parentesco=DB::table('paciente_responsable')->where('paciente_id', $pacienteID)->where('responsable_id',$responsable->id)->value('parentesco');

        return view('responsable/edit', ['responsable'=>$responsable,'parentesco'=>$parentesco,'pacienteID'=>$pacienteID] );

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
        $pacienteID=$request->get('pacienteID');
        $parentesco=$request->get('parentesco');
        $responsable = Responsable::find($id);
        $responsable->fill($request->all());
        $responsable->save();
        $responsable->pacientes()->updateExistingPivot($pacienteID,["parentesco"=>$parentesco]);
        return redirect('responsable/index/'.$pacienteID)->with('success', 'Elemento editado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $responsableID = $request->get('responsableID');
        $pacienteID = $request->get('pacienteID');
        $responsable = Responsable::find($responsableID);
        $responsable->delete();
        return redirect('responsable/index/'.$pacienteID)->with('success', 'Elemento eliminado correctamente');
    }
}
