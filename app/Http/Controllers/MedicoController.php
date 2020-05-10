<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Medico;
use App\User;

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
            'fotografia' => 'mimes:jpeg,bmp,png',
            'consulta' => 'required|alpha_num',
            'especialidad' => 'required|alpha_num'
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

    public function __construct()
    {
        $this->middleware('auth');
    }
}
