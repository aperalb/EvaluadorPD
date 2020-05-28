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
                    @if(!empty($evaluaciones))
                        <div class="panel-heading"><b>Todas mis evaluaciones</b></div>
                        <hr>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered" >
                            <tr>
                                <th>Fecha Inicio</th>
                                <th>Fecha Fin</th>
                                <th>Paciente</th>
                                <th style="text-align:center" colspan ="4">Acciones</th>
                            </tr>

                            @foreach($evaluaciones as $evaluacion)
                                <tr>
                                    <td>{{ date('Y-m-d', strtotime($evaluacion->created_at)) }}</td>
                                    @if($evaluacion->fechafin == "")
                                        <td>{{ 'En curso' }}</td>
                                    @else
                                        <td>{{ date('Y-m-d', strtotime($evaluacion->fechafin)) }}</td>
                                    @endif
                                    <td>{{ $evaluacion->paciente->user->getFullsurnameAttribute() }}</td>
                                    <td>
                                        {!! Form::open(['route' => ['evaluacion.show',$evaluacion->id], 'method' => 'get']) !!}
                                        {!! Form::submit('Detalles', ['class'=> 'btn btn-info'])!!}
                                        {!! Form::close() !!}
                                    </td>
                                    <td>
                                        <a class="btn btn-info" href="/evaluacionGrafica/verGrafica/{{$evaluacion->id}}">Resumen</a>
                                    </td>
                                    <td>
                                        {!! Form::open(['route' => ['evaluacion.destroy',$evaluacion->id], 'method' => 'delete']) !!}
                                        {!! Form::submit('Eliminar', ['class'=> 'btn btn-danger'])!!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </table>



                        {{--<td>--}}
                            {{--<a href={{ '/home' }} class="btn btn-info">Volver</a>--}}
                        {{--</td>--}}

                    </div>
                    @else
                        <div class="panel-heading">No tienes evaluaciones todavía</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection