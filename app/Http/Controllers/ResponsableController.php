<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Responsable;
use App\Paciente;
use DB;
use App\User;
use Auth;
use Illuminate\Support\Facades\Hash;


class ResponsableController extends Controller
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
        $user = new User();
        $user->fill($request->all());
        $user->name=$request->get('nombre');
        $user->password = Hash::make( $request->get('password'));
        $user->rol = 'RESPONSABLE';
        if($request->hasFile('fotografia')){
            $user->addMediaFromRequest('fotografia')->toMediaCollection('fotografias');
        }
        $responsable = new Responsable();
        $responsable->fill($request->all());

        $user->save();

        $responsable->user_id = $user->id;
        $responsable->save();
        $responsable->pacientes()->attach($paciente ->id,["parentesco"=>$parentesco]);

        /** Sacamos mensaje flash */
        /** Volvemos al índice de los Responsables*/
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
        Paciente::compruebaPertenencia($idPaciente);
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

        $responsable = Responsable::find($id);
        $pacienteID=$request->get('pacienteID');
        $parentesco=$request->get('parentesco');
        $user = $responsable->user;
        $user->fill($request->all());
        $user->name=$request->get('nombre');

        if($request->hasFile('fotografia')){
            try {
                $user->getMedia('fotografias')[0]->delete();
            }catch(\Exception $e){
                // Si no puede eliminar, que incluya la nueva imagen y punto.
            }
            $user->addMediaFromRequest('fotografia')->toMediaCollection('fotografias');
        }
        $user->save();
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
