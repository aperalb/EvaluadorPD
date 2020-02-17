@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group">
                            {{Form::label('Soy Administrador')}}
                            {{Form::checkbox('soyAdmin', '1')}}
                        </div>

                        <div>
                            {{Form::label('Nombre')}}
                            {{Form::text('name')}}
                        </div>

                        <div>
                            {{Form::label('Primer Apellido')}}
                            {{Form::text('apellido1')}}
                        </div>

                        <div>
                            {{Form::label('Segundo Apellido')}}
                            {{Form::text('apellido2')}}
                        </div>
                        <div>
                            {{Form::label('Consulta')}}
                            {{Form::text('consulta')}}
                        </div>
                        <div>
                            {{Form::label('Teléfono')}}
                            {{Form::text('numerotel')}}
                        </div>

                        <div>
                            {{Form::label('Especialidad')}}
                            {{Form::select('especialidad', array('Seleccionar','Neurología', 'Psiquiatria', 'Psicología', 'Fisioterapia','Otros'))}}
                        </div>
                        <div>
                            {{Form::label('Email')}}
                            {{Form::text('email')}}
                        </div>
                        <div>
                            {{Form::label('Password')}}
                            {{Form::password('password')}}
                        </div>
                        <div>
                            {{Form::label('Confirmar Password')}}
                            {{Form::password('password_confirmation')}}
                        </div>
                        <div>
                        {{Form::submit('Registrame')}}
                        </div>
                        {{Form::close()}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
