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
                    <div class="panel-heading">Tratamientos</div>

                    <div class="panel-body">
                        <table class="table table-striped table-bordered" >
                            <tr>
                                <th>Medicamento</th>
                                <th>Dosis</th>
                                <th>Frecuencia Diaria</th>
                                <th>Fecha de Inicio del Tratamiento</th>
                                <th>Fecha de Fin del Tratamiento</th>
                                <th align ="center" colspan ="3">Acciones</th>
                            </tr>
                            @foreach($tratamientos as $tratamiento)
                                <tr>
                                    <td>{{ $tratamiento->medicamento }}</td>
                                    <td>{{ $tratamiento->dosis }}</td>
                                    <td>{{ $tratamiento->frecuencia }}</td>
                                    <td>{{ $tratamiento->fechainicio}}</td>
                                    <td>{{ $tratamiento->fechafin}}</td>
                                    <td>
                                        {!! Form::open(['route' => ['tratamiento.show',$tratamiento->id], 'method' => 'get']) !!}
                                        {!! Form::submit('Detalles', ['class'=> 'btn btn-info'])!!}
                                        {!! Form::close() !!}
                                    </td>
                                    <td>
                                        {!! Form::open(['route' => ['tratamiento.edit',$tratamiento->id], 'method' => 'get']) !!}
                                        {!! Form::submit('Editar', ['class'=> 'btn btn-info'])!!}
                                        {!! Form::close() !!}                                    </td>
                                    <td>
                                        {!! Form::open(['route' => ['tratamiento.destroy',$tratamiento->id], 'method' => 'delete']) !!}
                                        {!! Form::submit('Eliminar', ['class'=> 'btn btn-info'])!!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </table>

                        <td>
                            <a href={{url('/tratamiento/create/?pacienteID='.$paciente->id)}} class="btn btn-info">Añadir Tratamiento</a>
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