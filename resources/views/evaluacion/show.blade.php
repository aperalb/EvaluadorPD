@extends('layouts.app')

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
                                @if($evaluacion->esFinalizada())
                                    <td>{{'Finalizada ' .date('yy-m-d', strtotime($evaluacion->fechafin))}}</td>
                                    @else
                                    <td>En curso</td>
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
                                <td colspan="10">Formularios disponibles</td>
                            </tr>

                            @foreach($formularios as $formulario)
                                <tr>
                                    <td> <a href={{url('/formulario/create/'.$formulario->id)}}  >{{$formulario->nombre}}</a> </td>

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