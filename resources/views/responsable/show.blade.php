@extends('layouts.app')

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
                                            {!! Form::open(['route' => ['responsable.show',$responsable->id], 'method' => 'get']) !!}
                                            {!! Form::submit('Editar', ['class'=> 'btn btn-info'])!!}
                                            {!! Form::close() !!}
                                        </td>
                                        <td>
                                            {!! Form::open(['route' => ['responsable.show',$responsable->id], 'method' => 'get']) !!}
                                            {!! Form::submit('Eliminar', ['class'=> 'btn btn-info'])!!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                        </table>
                        <td>
                            {!! Form::open(['route' => ['responsable.create'], 'method' => 'get']) !!}
                            {!! Form::submit('Añadir', ['class'=> 'btn btn-info'])!!}
                            {!! Form::close() !!}
                        </td>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection