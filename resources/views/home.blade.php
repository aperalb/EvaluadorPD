@extends('layouts.app')
@if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif
@if (\Session::has('danger'))
    <div class="alert alert-danger">
        <ul>
            <li>{!! \Session::get('danger') !!}</li>
        </ul>
    </div>
@endif

@section('content')
    <div class="container">
        <div class="row">
            <div >
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="floatLeft">

                            <h4>Mi Perfil</h4>

                            <table class="table table-striped table-bordered">
                                <tr>
                                    <th>{{ Auth::user()->name }} {{ Auth::user()->apellido1 }} {{ Auth::user()->apellido2 }}</th>
                                </tr>
                                <tr>
                                    <td rowspan="1">

                                        <img src="{{Auth::user()->medico->fotografia}}"
                                             width="300" height="300"
                                             onerror="this.onerror=null; this.src='/images/Default.jpg'"
                                             alt="Fotografia" />

                                    </td>

                                </tr>
                                <tr>
                                    <td rowspan="1">
                                        <strong>Consulta: </strong> {{ Auth::user()->medico->consulta}}

                                    </td>

                                </tr>
                                <tr>
                                    <td rowspan="1">
                                        <strong> Especialidad: </strong> {{ Auth::user()->medico->especialidad}}

                                    </td>

                                </tr>
                                <tr>
                                    <td>
                                        {!! Form::open(['route' => ['medico.edit',Auth::user()->id], 'method' => 'get']) !!}
                                        {!! Form::submit('Editar', ['class'=> 'btn btn-info'])!!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>

                            </table>

                        </div>
                        <div style="width: 10%; float: right;">
                            <br><br>
                            <table class="table table-striped table-bordered">

                                <tr>
                                    <td rowspan="1">
                                        <a href="{{route('paciente.index')}}" class="btn"><strong>Mis pacientes</strong>
                                            <img src="/images/pacientes.png"
                                                 width="200" height="200"
                                                 alt="Pacientes"

                                            />
                                        </a>
                                    </td>
                                </tr>
                                <tr ><td></td></tr>
                                <tr>
                                    <td rowspan="1">
                                        <a href="{{url('/medico/create')}}" class="btn"><strong>Mis evaluaciones</strong>
                                            <img src="/images/evaluaciones.png"
                                                 width="200" height="200"
                                                 alt="Evaluaciones"

                                            />
                                        </a>

                                    </td>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection