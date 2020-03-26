@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Mis pacientes</div>

                    <div class="panel-body">
                        <br><br>
                        <button>
                            <a href={{url('/paciente/create')}}><big><strong>Nuevo Paciente</strong></big></a>

                        </button>

                        <br><br>
                        <table class="table table-striped table-bordered" >
                            <tr>
                                <th colspan="6">Nombre Tabla</th>
                            </tr>

                            <tr>
                                <th>Nombre</th>
                                <th>Edad</th>
                                <th>NUHSA</th>
                                <th>Ver detalle</th>
                                <th>Evaluaciones</th>
                                <th>Ver responsables</th>
                            </tr>
                            @foreach ($pacientes as $paciente)
                                <tr>
                                    <td>{{ $paciente->getFullsurnameAttribute() }}</td>
                                    <td>{{ $paciente->getAgeAttribute() }}</td>
                                    <td>{{ $paciente->nuhsa}}</td>
                                    <td>
                                        {!! Form::open(['route' => ['paciente.show',$paciente->id], 'method' => 'get']) !!}
                                        {!! Form::submit('Detalles', ['class'=> 'btn btn-info'])!!}
                                        {!! Form::close() !!}
                                    </td>
                                    <td>
                                        {!! Form::open(['route' => ['paciente.show',$paciente->id], 'method' => 'get']) !!}
                                        {!! Form::submit('Evaluaciones', ['class'=> 'btn btn-info'])!!}
                                        {!! Form::close() !!}
                                    </td>

                                    <td>
                                    <a href={{url('/responsable/?id='.$paciente->id)}} class="btn btn-info">Responsables</a>
                                    </td>

                                </tr>
                            @endforeach
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection