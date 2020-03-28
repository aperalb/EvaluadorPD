@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">UPDATE PACIENTE</div>
                </div>
                <div class="panel-body">
                    {!! Form::model($paciente, [ 'route' => ['paciente.update',$paciente->id], 'method'=>'PUT', 'class'=>'form-inline']) !!}
                    <table id="datosPersonales" width="600" >
                        <tr>
                            <div class="form-group">
                                <td width="500" >
                                    {!! Form::label('nombre', 'Nombre ') !!}
                                </td>
                                <td width="500">
                                    {!! Form::text('nombre',$paciente->nombre,['class'=>'form-control', 'required', 'autofocus']) !!}
                                </td>
                            </div>
                        </tr>
                        <tr>
                            <div class="form-group">
                                <td width="500" >
                                    {!! Form::label('apellido1', 'Primer Apellido ') !!}
                                </td>
                                <td width="500">
                                    {!! Form::text('apellido1',$paciente->apellido1,['class'=>'form-control', 'required', 'autofocus']) !!}
                                </td>
                            </div>
                        </tr>
                        <tr>
                            <div class="form-group">
                                <td width="500" >
                                    {!! Form::label('apellido2', 'Segundo Apellido ') !!}
                                </td>
                                <td width="500">
                                    {!! Form::text('apellido2',$paciente -> apellido2,['class'=>'form-control', 'required', 'autofocus']) !!}
                                </td>
                            </div>
                        </tr>
                        <tr>
                            <div class="form-group">
                                <td width="500" >
                                    {!! Form::label('sexo', 'Sexo') !!}
                                </td>
                                <td width="500">
                                    @php
                                    $primerSexo = '';
                                    $segundoSexo = '';
                                    if($paciente->sexo == 'Hombre'){
                                        $primerSexo = 'Hombre';
                                        $segundoSexo = 'Mujer';
                                    }else{
                                        $primerSexo = 'Mujer';
                                        $segundoSexo = 'Hombre';
                                    }
                                    @endphp
                                    {!! Form::select('sexo', array($primerSexo, $segundoSexo),['class'=>'form-control', 'required', 'autofocus']) !!}
                                </td>
                            </div>
                        </tr>
                        <tr>
                            <div class="form-group">
                                <td width="500" >
                                    {!! Form::label('nuhsa', 'NUHSA') !!}
                                </td>
                                <td width="500">
                                    {!! Form::text('nuhsa',$paciente->nuhsa,['class'=>'form-control', 'required', 'autofocus']) !!}
                                </td>
                            </div>
                        </tr>
                        <tr>
                            <div class="form-group">
                                <td width="500" >
                                    {!! Form::label('fechanac', 'Fecha de Nacimiento') !!}
                                </td>
                                <td width="500">
                                    {!! Form::date('fechanac',$paciente->fechanac,['class'=>'form-control', 'required', 'autofocus']) !!}
                                </td>
                            </div>
                        </tr>
                        <tr>
                            <div class="form-group">
                                <td width="500" >
                                    {!! Form::label('numerotel', 'Numero de teléfono') !!}
                                </td>
                                <td width="500">
                                    {!! Form::text('numerotel',$paciente->numerotel,['class'=>'form-control', 'autofocus']) !!}
                                </td>
                            </div>
                        </tr>
                        <tr>
                            <div class="form-group">
                                <td width="500" >
                                    {!! Form::label('fechainiciopd', 'Fecha de inicio de PD') !!}
                                </td>
                                <td width="500">
                                    {!! Form::date('fechainiciopd',$paciente->fechainiciopd,['class'=>'form-control', 'autofocus']) !!}
                                </td>
                            </div>
                        </tr>
                        <tr>
                            <div class="form-group">
                                <td width="500" >
                                    {!! Form::label('observaciones', 'Observaciones') !!}
                                </td>
                                <td width="500">
                                    {!! Form::text('observaciones',$paciente->observaciones,['class'=>'form-control', 'autofocus']) !!}
                                </td>
                            </div>
                        </tr>

                    </table>

                    {!! Form::submit('Guardar',['class'=>'btn-primary btn']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection



