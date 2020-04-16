@extends('layouts.app')
@if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Evaluaciones</div>

                    <div class="panel-body">
                        <table class="table table-striped table-bordered" >
                            <tr>
                                <th>Fecha Inicio</th>
                                <th>Fecha Fin</th>
                                <th>Altura</th>
                                <th>Peso</th>
                                <th>Puntuación Global</th>
                                <th align ="center" colspan ="3">Acciones</th>
                            </tr>
                            @foreach($evaluaciones as $evaluacion)
                                <tr>
                                    <td>{{ date('yy-m-d', strtotime($evaluacion->created_at)) }}</td>
                                    @if($evaluacion->fechafin == "")
                                        <td>{{ 'No finalizada' }}</td>
                                    @else
                                        <td>{{ date('yy-m-d', strtotime($evaluacion->fechafin)) }}</td>
                                    @endif
                                    <td>{{ $evaluacion->altura }}</td>
                                    <td>{{ $evaluacion->peso}}</td>
                                    <td>{{ $evaluacion->puntuacionglobal}}</td>
                                    <td>
                                        {!! Form::open(['route' => ['evaluacion.show',$evaluacion->id], 'method' => 'get']) !!}
                                        {!! Form::submit('Detalles', ['class'=> 'btn btn-info'])!!}
                                        {!! Form::close() !!}
                                    </td>
                                    <td>
                                        {!! Form::open(['route' => ['evaluacion.edit',$evaluacion->id], 'method' => 'get']) !!}
                                        {!! Form::submit('Editar', ['class'=> 'btn btn-info'])!!}
                                        {!! Form::close() !!}                                    </td>
                                    <td>
                                        {!! Form::open(['route' => ['evaluacion.destroy',$evaluacion->id], 'method' => 'delete']) !!}
                                        {!! Form::submit('Eliminar', ['class'=> 'btn btn-info'])!!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </table>

                        <td>
                            <a href={{url('/evaluacion/create/?pacienteID='.$paciente->id)}} class="btn btn-info">Añadir Evaluación</a>
                        </td>
                        <td>
                            <a href={{ url()->previous() }} class="btn btn-info">Volver</a>
                        </td>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection