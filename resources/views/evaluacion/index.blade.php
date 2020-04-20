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
                <div class="panel-body">
                    <h4>Evaluaciones</h4>
                    <hr>

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
                                    @if($evaluacion->fechafin == null)
                                        <td>No Finalizada</td>
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
                                        {!! Form::open(['route' => ['evaluacion.destroy',$evaluacion->id], 'method' => 'delete']) !!}
                                        {!! Form::submit('Eliminar', ['class'=> 'btn btn-info'])!!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </table>


                        <div>
                            <td>
                                <a href={{ '/paciente/'.$paciente->id }} class="btn btn-info">Volver</a>
                            </td>
                        </div>


                    </div>

                    <div>
                        <br>
                        <br>
                        <h5>Añadir Evaluación</h5>
                        <hr>
                        {!! Form::open(['route' => 'evaluacion.store', 'class'=>'form-inline']) !!}

                        <table id="addEvaluacion" class=" table-bordered table-striped">
                            <tr>
                                <div class="form-group">
                                    <td width="100" >
                                        {!! Form::label('altura', 'Altura ') !!}
                                    </td>
                                    <td width="">
                                        {!! Form::number('altura',null,['class'=>'form-control', 'required', 'autofocus','step' => '0.1']) !!}
                                    </td>
                                </div>
                            </tr>
                            <tr>
                                <div class="form-group">
                                    <td width="100" >
                                        {!! Form::label('peso', 'Peso') !!}
                                    </td>
                                    <td width="">
                                        {!! Form::number('peso',null,['class'=>'form-control', 'required', 'autofocus','step' => '0.1']) !!}
                                    </td>
                                </div>
                            </tr>
                            <tr style="display: none">
                                <div class="form-group">
                                    <td width="">
                                        {!! Form::hidden('pacienteID', $paciente->id) !!}</td>
                                </div>
                            </tr>
                            <tr>
                                <div class="form-group">
                                    <td colspan="2">
                                        {!! Form::submit('Guardar',['class'=>'btn-primary btn']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </div>
                            </tr>
                        </table>

                    </div>




                </div>
            </div>
        </div>
    </div>
@endsection