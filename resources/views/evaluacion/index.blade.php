@extends('layouts.app')
@if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif
@section('content')
    @if(count($errors))
        <div class="form-group">
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
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
                                @if(Auth::User()->showRol()=='MEDICO')
                                <th align ="center" colspan ="3">Acciones</th>
                                @else
                                    <th align ="center" colspan ="1">Acciones</th>
                                @endif

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
                                    <td>
                                        {!! Form::open(['route' => ['evaluacion.show',$evaluacion->id], 'method' => 'get']) !!}
                                        {!! Form::submit('Detalles', ['class'=> 'btn btn-info'])!!}
                                        {!! Form::close() !!}
                                    </td>
                                    @if(Auth::User()->showRol()=='MEDICO')

                                    <td>
                                        {!! Form::open(['route' => ['evaluacion.destroy',$evaluacion->id], 'method' => 'delete']) !!}
                                        {!! Form::submit('Eliminar', ['style'=>"margin-top: 1%",'class'=> 'btn btn-danger','onClick'=>'return confirm("¿Seguro que deseas eliminar esta pregunta?");'])!!}
                                        {!! Form::close() !!}
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                        </table>


                        <div>
                            <td>
                                <a href={{ '/paciente/'.$paciente->id }} class="btn btn-info">Volver</a>
                            </td>
                        </div>


                    </div>
                    @if(Auth::User()->showRol()=='MEDICO')
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
                                        {!! Form::number('altura',null,['class'=>'form-control', 'required', 'autofocus','step' => '0.01']) !!}
                                    </td>
                                </div>
                            </tr>
                            <tr>
                                <div class="form-group">
                                    <td width="100" >
                                        {!! Form::label('peso', 'Peso') !!}
                                    </td>
                                    <td width="">
                                        {!! Form::number('peso',null,['class'=>'form-control', 'required', 'autofocus','step' => '0.01']) !!}
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
                    @endif




                </div>
            </div>
        </div>
    </div>
@endsection