<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Responsable;
use App\Paciente;
use DB;
use App\User;
use Auth;

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
        User::validaRol('MEDICO');
        $pacienteID = $request->get('pacienteID');
        return view('responsable/create', ['pacienteID'=>$pacienteID]);
    }


    public function store(Request $request)
    {
        User::validaRol('MEDICO');
        $id=$request->get('pacienteID');
        $parentesco=$request->get('parentesco');
        $paciente = Paciente::find($id);
        $this->validate($request, []);

        /** Creamos el nuevo paciente*/
        $responsable = new Responsable();
        $responsable->nombre=$request->get('nombre');
        $responsable->apellido1=$request->get('apellido1');
        $responsable->apellido2 = $request->get('apellido2');
        $responsable->numerotel = $request->get('numerotel');
        $responsable->direccion = $request->get('direccion');
        $responsable->email = $request->get('email');
        $responsable->fotografia = $request->get('fotografia');

        $responsable->save();
        $responsable->pacientes()->attach($paciente ->id,["parentesco"=>$parentesco]);

        /** Sacamos mensaje flash */
        /** Volvemos al índice de los Pacientes*/
        return redirect('responsable/index/'.$id)->with('success', 'Elemento agregado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show2($idResponsable, $idPaciente)
    {

        $responsable = Responsable::find($idResponsable);
        $paciente = Paciente::find($idPaciente);
        return view('responsable.show', ['responsable'=>$responsable,'paciente'=>$paciente]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editar(Request $request)
    {
        User::validaRol('MEDICO');
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
        User::validaRol('MEDICO');
        $pacienteID=$request->get('pacienteID');
        $parentesco=$request->get('parentesco');
        $responsable = Responsable::find($id);
        $responsable->fill($request->all());
        $responsable->save();
        $responsable->pacientes()->updateExistingPivot($pacienteID,["parentesco"=>$parentesco]);

//        return redirect()->route('responsable.show2',['idResponsable'=>$responsable->id, 'idPaciente' => $pacienteID])->with('success', 'Elemento editado correctamente');
        return redirect('responsable/'.$responsable->id.'/'.$pacienteID)->with('succes', 'Elemento editado correctamente');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        User::validaRol('MEDICO');
        $responsableID = $request->get('responsableID');
        $pacienteID = $request->get('pacienteID');
        $responsable = Responsable::find($responsableID);
        $responsable->delete();
        return redirect('responsable/index/'.$pacienteID)->with('danger', 'Elemento eliminado correctamente');
    }
}
