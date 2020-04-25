<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use App\Medico;
use App\Administrador;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Image;

use Illuminate\Auth\Events\Registered;

use Illuminate\Support\Facades\Auth;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */


    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all(),$request)));

        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'apellido1' => ['required', 'string', 'max:255'],
            'apellido2' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data, Request $request)
    {


        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'apellido1' => $data['apellido1'],
            'apellido2' => $data['apellido2'],
            'rol' => 'MEDICO',
            'password' => Hash::make($data['password'])]);
        if (isset($data['fotografia'])) {
            $user->addMediaFromRequest('fotografia')->toMediaCollection('fotografias');
        }

        if($data['consulta']!=null && $data['numerotel']!=null && $data['especialidad']!=null){
            $medico = new Medico();
            $medico->consulta=$data['consulta'];
            $medico->especialidad=$data['especialidad'];
            $medico->numerotel=$data['numerotel'];
            $medico->user_id = $user->id;
            $medico->fotografia = $data['fotografia'];
            $medico->save();
        }


        return $user;

    }
}
