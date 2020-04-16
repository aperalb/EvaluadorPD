@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Nueva evaluación del paciente</div>

            </div>
            <div class="panel-body">
                {!! Form::open(['route' => 'evaluacion.store', 'class'=>'form-inline']) !!}
                <table id="datosPersonales" width="600" >
                    <tr>
                        <div class="form-group">
                         <td width="500" >
                             {!! Form::label('altura', 'Altura ') !!}
                         </td>
                         <td width="500">
                             {!! Form::text('altura',null,['class'=>'form-control', 'required', 'autofocus']) !!}
                         </td>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                            <td width="500" >
                                {!! Form::label('peso', 'Peso') !!}
                            </td>
                            <td width="500">
                                {!! Form::text('peso',null,['class'=>'form-control', 'required', 'autofocus']) !!}
                            </td>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                            <td width="500" >
                                {!! Form::label('fechafin', 'Fecha fin') !!}
                            </td>
                            <td width="500">
                                {!! Form::date('fechafin',null,['class'=>'form-control', 'autofocus']) !!}
                            </td>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                            <td width="500" >
                                {!! Form::label('puntuacionglobal', 'Puntuacion Global') !!}
                            </td>
                            <td width="500">
                                {!! Form::text('puntuacionglobal',null,['class'=>'form-control', 'autofocus']) !!}
                            </td>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                            <td width="500">
                                {!! Form::hidden('pacienteID', $pacienteID) !!}</td>
                        </div>
                    </tr>
                </table>
                {!! Form::submit('Guardar',['class'=>'btn-primary btn']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection




