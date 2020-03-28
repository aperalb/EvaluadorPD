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
                    <div class="panel-heading">Responsables</div>

                    <div class="panel-body">
                        <table class="table table-striped table-bordered" >
                            <tr>
                                <th>Nombre</th>
                                <th>Teléfono</th>
                                <th>Dirección</th>
                                <th align ="center" colspan ="2">Acciones</th>
                            </tr>
                            @foreach($responsables as $responsable)
                                <tr>
                                    <td>{{ $responsable->getFullsurnameAttribute() }}</td>
                                    <td>{{ $responsable->numerotel }}</td>
                                    <td>{{ $responsable->direccion}}</td>
                                    <td>
                                        <a href={{url('/responsable/editar/?responsableID='.$responsable->id."&&pacienteID=".$paciente->id)}} class="btn btn-info">Editar</a>
                                    </td>
                                    {{--<td>--}}
                                        {{--{!! Form::open(['route' => ['responsable.destroy',$responsable->id], 'method' => 'delete']) !!}--}}
                                        {{--{!! Form::submit('Eliminar', ['class'=> 'btn btn-info'])!!}--}}
                                        {{--{!! Form::close() !!}--}}
                                    {{--</td>--}}
                                    <td>
                                        <a href={{url('/responsable/delete/?responsableID='.$responsable->id."&&pacienteID=".$paciente->id)}} class="btn btn-info">Eliminar</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>

                        <td>
                            <a href={{url('/responsable/create/?pacienteID='.$paciente->id)}} class="btn btn-info">Crear Responsable</a>
                        </td>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection