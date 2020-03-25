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

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>



                            <div class="form-group row">
                            <label for="apellido1" class="col-md-4 col-form-label text-md-right">{{ __('Apellidos1') }}</label>

                            <div class="col-md-6">
                                <input id="apellido1" type="text" class="form-control{{ $errors->has('apellidos') ? ' is-invalid' : '' }}" name="apellido1" value="{{ old('apellido1') }}" required autofocus>

                                @if ($errors->has('apellido1'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('apellidos') }}</strong>
                                    </span>
                                @endif
                            </div>
                            </div>

                            <div class="form-group row">
                                <label for="apellido2" class="col-md-4 col-form-label text-md-right">{{ __('Apellidos2') }}</label>

                                <div class="col-md-6">
                                    <input id="apellido2" type="text" class="form-control{{ $errors->has('apellido2') ? ' is-invalid' : '' }}" name="apellido2" value="{{ old('apellido2') }}" required autofocus>

                                    @if ($errors->has('apellido2'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('apellido2') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo Electrónico') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>
                            <!-- Numero de teléfono-->
                            <div class="form-group row">
                                <label for="numerotel" class="col-md-4 col-form-label text-md-right">{{ __('Número de teléfono') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control{{ $errors->has('numerotel') ? ' is-invalid' : '' }}" name="numerotel"  required autofocus>

                                    @if ($errors->has('numerotel'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('numerotel') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <!-- Consulta -->
                            <div class="form-group row">
                                <label for="consulta" class="col-md-4 col-form-label text-md-right">{{ __('Consulta') }}</label>

                                <div class="col-md-6">
                                    <input id="consulta" type="text" class="form-control{{ $errors->has('consulta') ? ' is-invalid' : '' }}" name="consulta"  required autofocus>

                                    @if ($errors->has('consulta'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('consulta') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Especialidad-->
                            <div class="form-group row">
                                <label for="especialidad" class="col-md-4 col-form-label text-md-right">{{ __('Especialidad') }}</label>

                                <div class="col-md-6">
                                    <input id="especialidad" type="text" class="form-control{{ $errors->has('especialidad') ? ' is-invalid' : '' }}" name="especialidad"  required autofocus>

                                    @if ($errors->has('especialidad'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('especialidad') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
