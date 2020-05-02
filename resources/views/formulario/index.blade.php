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
            <div class="col-md-10 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"></div>

                    <div class="panel-body">

                        <h4>Formularios disponibles en el sistema</h4>
                        <hr>
                        <div class="panel-body">
                            <table class="table table-striped table-bordered" >
                                <tr>
                                    <th>Nombre</th>
                                    <th>Nº preguntas</th>
                                    <th>Puntuación Máxima</th>
                                    <th colspan="3">Acciones</th>


                                </tr>
                                @foreach($formularios as $formulario)
                                    <tr>
                                        <td>{{$formulario->nombre }}</td>
                                        <td>{{$formulario->numeroPreguntas($formulario->id) }}</td>
                                        <td>{{ $formulario->max}}</td>
                                        <td>
                                            <a href={{url('/formulario/showList/'.$formulario->id)}} class="btn btn-info">Ver formulario</a>
                                        </td>

                                            <td>
                                                {{--{!! Form::open(['route' => ['formulario.destroy',$formulario->id], 'method' => 'delete']) !!}--}}
                                                {!! Form::submit('Editar', ['class'=> 'btn btn-success'])!!}
                                                {{--{!! Form::close() !!}--}}
                                            </td>
                                        <td>
                                            {{--{!! Form::open(['route' => ['formulario.destroy',$formulario->id], 'method' => 'delete']) !!}--}}
                                            {!! Form::submit('Eliminar', ['class'=> 'btn btn-danger'])!!}
                                            {{--{!! Form::close() !!}--}}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>

                            <td>
                                <a href={{url('/formulario/add')}} class="btn btn-info">Nuevo Formulario</a>
                            </td>
                            <td>
                                <a href={{ url('/home') }} class="btn btn-info">Volver</a>
                            </td>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection