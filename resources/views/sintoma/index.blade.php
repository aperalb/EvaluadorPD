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

                        <div class="panel panel-default">
                            <h4>Síntomas presentados por {{$paciente->getFullsurnameAttribute()}}</h4>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Detalles</th>
                                <th>Categoria De Síntoma</th>
                                <th align="center" colspan="3">Acciones</th>
                            </tr>
                            @foreach($sintomas as $sintoma)
                                <tr>
                                    <td>{{ $sintoma->nombre }}</td>
                                    <td>{{ $sintoma->descripcion }}</td>
                                    <td>{{ $sintoma->detalles}}</td>
                                    <td>{{ $sintoma->categoriasintoma}}</td>
                                    <td>
                                        {!! Form::open(['route' => ['sintoma.edit',$sintoma->id], 'method' => 'get']) !!}
                                        {!! Form::submit('Editar', ['class'=> 'btn btn-info'])!!}
                                        {!! Form::close() !!}
                                    </td>
                                    <td>
                                        {!! Form::open(['route' => ['sintoma.destroy',$sintoma->id], 'method' => 'delete']) !!}
                                        {!! Form::submit('Eliminar', ['class'=> 'btn btn-info'])!!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </table>

                        <td>
                            <a href={{url('/sintoma/create/?pacienteID='.$paciente->id)}} class="btn btn-info">Añadir
                            Síntoma</a>
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