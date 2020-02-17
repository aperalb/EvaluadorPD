@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">CREATE PACIENTE</div>
            </div>
            <div class="panel-body">
                {!! Form::open(['route' => 'paciente.store', 'class'=>'form-inline']) !!}
                <table id="datosPersonales" width="600" >
                    <tr>
                        <div class="form-group">
                         <td width="500" >
                             {!! Form::label('nombre', 'Nombre ') !!}
                         </td>
                         <td width="500">
                             {!! Form::text('nombre',null,['class'=>'form-control', 'required', 'autofocus']) !!}
                         </td>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                            <td width="500" >
                                {!! Form::label('apellido1', 'Primer Apellido ') !!}
                            </td>
                            <td width="500">
                                {!! Form::text('apellido1',null,['class'=>'form-control', 'required', 'autofocus']) !!}
                            </td>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                            <td width="500" >
                                {!! Form::label('apellido2', 'Segundo Apellido ') !!}
                            </td>
                            <td width="500">
                                {!! Form::text('apellido2',null,['class'=>'form-control', 'required', 'autofocus']) !!}
                            </td>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                            <td width="500" >
                                {!! Form::label('sexo', 'Sexo') !!}
                            </td>
                            <td width="500">
                                {!! Form::select('sexo', array('Hombre' => 'Hombre', 'Mujer' => 'Mujer'),['class'=>'form-control', 'required', 'autofocus']) !!}
                            </td>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                            <td width="500" >
                                {!! Form::label('nuhsa', 'NUHSA') !!}
                            </td>
                            <td width="500">
                                {!! Form::text('nuhsa',null,['class'=>'form-control', 'required', 'autofocus']) !!}
                            </td>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                            <td width="500" >
                                {!! Form::label('fechanac', 'Fecha de Nacimiento') !!}
                            </td>
                            <td width="500">
                                {!! Form::date('fechanac',null,['class'=>'form-control', 'required', 'autofocus']) !!}
                            </td>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                            <td width="500" >
                                {!! Form::label('numerotel', 'Numero de teléfono') !!}
                            </td>
                            <td width="500">
                                {!! Form::text('numerotel',null,['class'=>'form-control', 'autofocus']) !!}
                            </td>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                            <td width="500" >
                                {!! Form::label('fechainiciopd', 'Fecha de inicio de PD') !!}
                            </td>
                            <td width="500">
                                {!! Form::date('fechainiciopd',null,['class'=>'form-control', 'autofocus']) !!}
                            </td>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                            <td width="500" >
                                {!! Form::label('observaciones', 'Observaciones') !!}
                            </td>
                            <td width="500">
                                {!! Form::text('observaciones',null,['class'=>'form-control', 'autofocus']) !!}
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



