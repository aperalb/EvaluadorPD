@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Introduzca los datos del Nuevo Tratamiento</div>

            </div>
            <div class="panel-body">
                {!! Form::open(['route' => 'tratamiento.store', 'class'=>'form-inline']) !!}
                <table id="datosPersonales" width="600" >
                    <tr>
                        <div class="form-group">
                         <td width="500" >
                             {!! Form::label('medicamento', 'Medicamento ') !!}
                         </td>
                         <td width="500">
                             {!! Form::text('medicamento',null,['class'=>'form-control', 'required', 'autofocus']) !!}
                         </td>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                            <td width="500" >
                                {!! Form::label('dosis', 'Dosis ') !!}
                            </td>
                            <td width="500">
                                {!! Form::text('dosis',null,['class'=>'form-control', 'required', 'autofocus']) !!}
                            </td>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                            <td width="500" >
                                {!! Form::label('frecuencia', 'Frecuencia Diaria ') !!}
                            </td>
                            <td width="500">
                                {!! Form::text('frecuencia',null,['class'=>'form-control', 'required', 'autofocus']) !!}
                            </td>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                            <td width="500" >
                                {!! Form::label('fechainicio', 'Fecha de Inicio ') !!}
                            </td>
                            <td width="500">
                                {!! Form::date('fechainicio',null,['class'=>'form-control', 'autofocus']) !!}
                            </td>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                            <td width="500" >
                                {!! Form::label('fechafin', 'Fecha de Fin ') !!}
                            </td>
                            <td width="500">
                                {!! Form::date('fechafin',null,['class'=>'form-control', 'autofocus']) !!}
                            </td>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                            <td width="500" >
                                {!! Form::label('detalles', 'Detalles ') !!}
                            </td>
                            <td width="500">
                                {!! Form::textarea('detalles',null,['class'=>'form-control', 'required', 'autofocus']) !!}
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




