<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Paciente;
use App\Medico;
use Flash;
use App\User;
use Illuminate\Support\Facades\Hash;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        User::validaRol('MEDICO');
        $medico = Medico::find(Auth::user()->medico->id);
        $pacientes = $medico->pacientes;

        return view('paciente.index', ['pacientes'=>$pacientes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        User::validaRol('MEDICO');
        return view('paciente/create');
    }

    public function store(Request $request)
    {
//        dd($request);
        User::validaRol('MEDICO');
        $validatedData = $request->validate([
            'nombre' => 'required|alpha',
            'apellido1'=>'required|alpha',
            'apellido2'=>'required|alpha',
            'email'=> 'required|email:rfc|unique:users',
            'sexo' => 'required|in:Hombre,Mujer',
            'numerotel'=> 'nullable|alpha_num|max:9',
            'nuhsa' => 'required|unique:pacientes',
            'fotografia' => 'nullable|mimes:jpeg,bmp,png',
            'password' => 'required|alpha_num',
            'fechainiciopd' =>'required|before_or_equal:today',
            'fechanac' => 'required|before:today'
        ]);
        $user = User::create([
            'name' => $request->get('nombre'),
            'rol' => 'PACIENTE',
            'apellido1' =>  $request->get('apellido1'),
            'apellido2' =>  $request->get('apellido2'),
            'email' => $request->get('email'),
            'password' => Hash::make( $request->get('password'))]);

        /** Creamos el nuevo paciente*/
        $paciente = new Paciente($request->all());
        $paciente->user_id = $user->id;
//        dd($request['fotografia']);
        if ($request['fotografia']) {
            $user->addMediaFromRequest('fotografia')->toMediaCollection('fotografias');
        }
        $user->save();
        $paciente->save();
        $medico = Auth::user()->medico;
        $paciente->medicos()->attach($medico->id);

        /** Sacamos mensaje flash */
        /** Volvemos al índice de los Pacientes*/
        return redirect()->route('paciente.show',[$paciente->id]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Paciente::compruebaPertenencia($id);
        $paciente = Paciente::find($id);
        return view('paciente.show', ['paciente'=>$paciente]);
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
        $paciente  = Paciente::find($id);
        return view('paciente/edit', ['paciente'=>$paciente] );


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
            'nombre' => 'required|alpha',
            'apellido1'=>'required|alpha',
            'apellido2'=>'required|alpha',
            'sexo' => 'required|in:Hombre,Mujer',
            'numerotel'=> 'nullable|alpha_num|max:9',
            'fotografia' => 'nullable|mimes:jpeg,bmp,png',
            'fechainiciopd' =>'required|before_or_equal:today',
            'fechanac' => 'required|before:today'
        ]);
        $paciente = Paciente::find($id);
        $user = $paciente->user;
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


        $paciente->fill($request->all());
        $paciente->save();
        return redirect()->route('paciente.show',[$paciente->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        User::validaRol('MEDICO');
        $paciente = Paciente::find($id);
        $paciente->delete();
        return redirect()->route('paciente.index');
    }



    public function __construct()
    {
        $this->middleware('auth');
    }

}
