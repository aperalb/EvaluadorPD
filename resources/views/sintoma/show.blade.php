@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Detalle Tratamiento</div>

                    <div class="panel-body">
                        <table class="table table-striped table-bordered" white-space="nowrap" >
                                <tr>
                                    <th>Medicamento</th>
                                    <th>{{ $tratamiento->medicamento }}</th>
                                </tr>
                                <tr>
                                    <td>Dosis</td>
                                    <td>{{ $tratamiento->dosis }}</td>
                                </tr>
                                <tr>
                                    <td>Frecuencia Diaria</td>
                                    <td>{{ $tratamiento->frecuencia }}</td>
                                </tr>
                                <tr>
                                    <td>Fecha Fin</td>
                                    <td>{{ $tratamiento->fechainicio }}</td>
                                </tr>
                                <tr>
                                    <td>Fecha Fin</td>
                                    <td>{{ $tratamiento->fechafin }}</td>
                                </tr>
                            <tr>
                                <td>Detalles</td>
                                <td style="display: inline-block;">
                                    <p>{{ $tratamiento->detalles }}</p>
                                </td>
                            </tr>
                            </table>
                        <tr>
                            <div>
                                <td>
                                    {!! Form::open(['route' => ['responsable.create'], 'method' => 'get']) !!}
                                    {!! Form::submit('Añadir', ['class'=> 'btn btn-info'])!!}
                                    {!! Form::close() !!}
                                    <br/>
                                    <a href={{ url()->previous() }} class="btn btn-info">Volver</a>
                                </td>
                            </div>
                        </tr>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection