@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center" >
            <div class="" style="height:100%; width:100%;">
                <div class="card" style="height:100%; width:100%;" >
                    <div class="card-header">Registrarse como Médico</div>

                    <div class="card-body" style="height:75%; width:75%;">
                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="panel-body">
                                <div class="floatLeft">



                                    <table class="table table-striped table-bordered">


                                        <tr>
                                            <div class="form-group">
                                                <th>Nombre</th>
                                                <td><input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                                    @if ($errors->has('name'))
                                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                                    @endif</td>
                                            </div>
                                        </tr>
                                        <tr>
                                            <th>Apellido 1</th>
                                            <td>  <input id="apellido1" type="text" class="form-control{{ $errors->has('apellido1') ? ' is-invalid' : '' }}" name="apellido1" value="{{ old('apellido1') }}" required autofocus>

                                                @if ($errors->has('apellido1'))
                                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('apellido1') }}</strong>
                                    </span>
                                                @endif</td>
                                        </tr>
                                        <tr>
                                            <th>Apellido 2</th>
                                            <td>  <input id="apellidos" type="text" class="form-control{{ $errors->has('apellido2') ? ' is-invalid' : '' }}" name="apellido2" value="{{ old('apellido2') }}" required autofocus>

                                                @if ($errors->has('apellido2'))
                                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('apellido2') }}</strong>
                                    </span>
                                                @endif</td>
                                        </tr>

                                        <tr>
                                            <th>Email</th>
                                            <td>  <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                                @endif</td>
                                        </tr>


                                        <tr>
                                            <th>Password</th>
                                            <td>
                                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                                @if ($errors->has('password'))
                                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                                @endif
                                            </td>
                                        </tr>


                                        <tr>
                                            <th>Confirm Password</th>
                                            <td>
                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                            </td>
                                        </tr>


                                        <tr>
                                            <th>Número Telefono</th>
                                            <td> <input id="name" type="text" class="form-control{{ $errors->has('numerotel') ? ' is-invalid' : '' }}" name="numerotel"  required autofocus>

                                                @if ($errors->has('numerotel'))
                                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('numerotel') }}</strong>
                                    </span>
                                                @endif</td>
                                        </tr>

                                        <tr>
                                            <th>Consulta</th>
                                            <td>
                                                <input id="consulta" type="text" class="form-control{{ $errors->has('consulta') ? ' is-invalid' : '' }}" name="consulta"  required autofocus>

                                                @if ($errors->has('consulta'))
                                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('consulta') }}</strong>
                                    </span>
                                                @endif
                                            </td>
                                        </tr>



                                        <tr>
                                            <th>Especialidad</th>
                                            <td>
                                                <input id="especialidad" type="text" class="form-control{{ $errors->has('especialidad') ? ' is-invalid' : '' }}" name="especialidad"  required autofocus>

                                                @if ($errors->has('especialidad'))
                                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('especialidad') }}</strong>
                                    </span>
                                                @endif
                                            </td>
                                        </tr>


                                    </table>


                                </div>

                                <div class="floatRight">
                                    <table class="table table-striped table-bordered">

                                        <tr>
                                            <td rowspan="1">

                                                <img src="/images/Default.jpg"
                                                     width="300" height="300"
                                                     onerror="this.onerror=null; this.src='/images/Default.jpg'"
                                                     alt="Fotografia" id="fotografia"/>
                                            </td>

                                        </tr>
                                        <tr>
                                            <th>
                                                URL Fotografía
                                            </th>

                                        </tr>
                                        <tr>
                                            <td>

                                                <input id="fotografia" type="file" class="form-control{{ $errors->has('fotografia') ? ' is-invalid' : '' }}" name="fotografia" autofocus maxlength="1000">

                                            </td>

                                        </tr>
                                        <tr>
                                            <td>
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Register') }}
                                                </button>
                                            </td>
                                        </tr>

                                    </table>

                                </div>

                            </div>

                        </form>
                    </div>

                </div>

            </div>

        </div>
    </div>


@endsection