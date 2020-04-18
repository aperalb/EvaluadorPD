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
            <div >
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="floatLeft">

                            <h4>Detalles de la Evaluación</h4>
                            <table class="table table-striped table-bordered">


                                <tr>
                                    <th>Fecha Inicio</th>
                                    <td>{{date('yy-m-d', strtotime($evaluacion->created_at))}}</td>
                                </tr>
                                <tr>
                                    <th>Estado</th>
                                @if($evaluacion->fechafin == "")
                                        <td>En curso</td>
                                    @else
                                        <td>{{'Finalizada ' .date('yy-m-d', strtotime($evaluacion->fechafin))}}</td>
                                    @endif
                                </tr>

                                <tr>
                                    <th>Peso actual del paciente</th>
                                    <td>{{ $evaluacion->peso .' kg'}}</td>
                                </tr>
                                <tr>
                                    <th>Altura actual del paciente</th>
                                    <td>{{ $evaluacion->altura . ' m' }}</td>
                                </tr>

                            </table>
                            <br>
                            <div>
                                <h4>Observaciones</h4>
                                <a>  <pre><textarea readonly cols="80" rows="10">//TODO: OBSERVACIONES DE LA EVALUACION</textarea></pre></a>
                            </div>

                        </div>

                        <div class="floatRight">
                            <table class="table table-striped table-bordered">
                                <tr>
                                    <td rowspan="1"  style="text-align: center; font-size: 30px">

                                        <a>Puntuación</a>

                                    </td>

                                </tr>
                                <tr>
                                    <td rowspan="1"  style="text-align: center; font-size: 50px">

                                        <a>69</a>

                                    </td>

                                </tr>

                            </table>
                        </div>

                        <table class="table table-striped table-bordered">
                            <tr>
                                <td colspan="10">Formularios Pendientes</td>
                            </tr>

                            @foreach($formulariosNorealizados as $formulario)
                                <tr>
                                    <td>
                                        {!! Form::open(['route' => ['formulario.create','idFormulario'=>$formulario->id,'idEvaluacion'=> $evaluacion->id], 'method' => 'get']) !!}
                                        {!! Form::submit($formulario->nombre, ['class'=> 'btn btn-link','style'=>"width: 100%; text-align:left"])!!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>

                            @endforeach
                        </table>

                        <table class="table table-striped table-bordered">
                            <tr>
                                <td colspan="10">Formularios Realizados</td>
                            </tr>

                            @foreach($formulariosRealizados as $formulario)
                                <tr>
                                    <td>
                                        {!! Form::open(['route' => ['formulario.show','idFormulario'=>$formulario->id,'idEvaluacion'=> $evaluacion->id], 'method' => 'get']) !!}
                                        {!! Form::submit($formulario->nombre, ['class'=> 'btn btn-link','style'=>"width: 100%; text-align:left"])!!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>

                            @endforeach
                        </table>


                        <td>
                            <a href={{ url('/paciente') }} class="btn btn-info">Volver</a>
                        </td>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection