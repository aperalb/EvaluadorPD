@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Pacientes</div>

                    <div class="panel-body">
                        <table class="table table-striped table-bordered">
                            <tr>
                                <td colspan="10">Datos personales del paciente</td>
                            </tr>
                            <tr>
                                <td colspan="7">Datos personales del paciente</td>
                                <td colspan="1">
                                    <a href={{url('/tratamiento/index/'.$paciente->id)}} class="btn btn-info">Tratamientos</a>
                                </td>

                            </tr>
                            <td>Nombre</td>
                            <td>Sexo</td>
                            <td>NUHSA</td>
                            <td>Fecha de nacimiento</td>
                            <td>Contacto</td>
                            <td>Año de inicio PD</td>
                            <td>Observaciones</td>
                            </tr>
                            <tr>
                                <td>{{ $paciente->getFullsurnameAttribute() }}</td>
                                <td>{{ $paciente->sexo }}</td>
                                <td>{{ $paciente->nuhsa }}</td>
                                <td>{{ $paciente->fechanac }}</td>
                                <td>{{ $paciente->numerotel }}</td>
                                <td>{{ $paciente->getAgeInitPD() }}</td>
                                <td>{{$paciente->observaciones}}</td>
                            </tr>
                        </table>

                        <table class="table table-striped ">
                            <tr>
                                <td>
                                    {!! Form::open(['route' => ['paciente.edit',$paciente->id], 'method' => 'get']) !!}
                                    {!! Form::submit('Editar', ['class'=> 'btn btn-info'])!!}
                                    {!! Form::close() !!}
                                </td>
                                <td>
                                    {!! Form::open(['route' => ['paciente.destroy',$paciente->id], 'method' => 'delete']) !!}
                                    {!! Form::submit('Eliminar', ['class'=> 'btn btn-info'])!!}
                                    {!! Form::close() !!}
                                </td>
                                <td>
                                <td>
                                    <a href={{url('/responsable/index/'.$paciente->id)}} class="btn btn-info">Responsables</a>
                                    <a href={{url('/responsable/create/?pacienteID='.$paciente->id)}} class="btn btn-info">Añadir</a>
                                </td>

                                </td>
                            </tr>
                        </table>

                        <div>
                            <td>
                                {!! Form::open(['route' => ['paciente.edit',$paciente->id], 'method' => 'get']) !!}
                                {!! Form::submit('Editar', ['class'=> 'btn btn-info'])!!}
                                {!! Form::close() !!}
                            </td>
                        </div>
                        <table class="table table-striped table-bordered">
                            <tr>
                                <td colspan="10">Datos cuantitativos</td>
                            </tr>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection