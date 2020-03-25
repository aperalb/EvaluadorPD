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
                            <td>Nombre</td>
                            <td> Apellidos</td>
                            <td>Sexo</td>
                            <td>NUHSA</td>
                            <td>Fecha de nacimiento</td>
                            <td>Contacto</td>
                            <td>Año de inicio PD</td>
                            <td>Observaciones</td>
                            </tr>
                            <tr>
                                <td>{{ $paciente->nombre }}</td>
                                <td>{{ $paciente->getFullsurnameAttribute() }}</td>
                                <td>{{ $paciente->sexo }}</td>
                                <td>{{ $paciente->nuhsa }}</td>
                                <td>{{ $paciente->fechanac }}</td>
                                <td>{{ $paciente->numerotel }}</td>
                                <td>{{ $paciente->getAgeInitPD() }}</td>
                                <td>{{$paciente->observaciones}}</td>
                            </tr>
                        </table>
                        <div></div>
                        <table class="table table-striped table-bordered">
                            <tr>
                                <td>
                                    <a href={{url('/responsable/?id='.$paciente->id)}} class="btn btn-info">Ver Responsables</a>
                                </td>
                                <td>Añadir responsable</td>
                            </tr>
                        </table>

                        <div></div>
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