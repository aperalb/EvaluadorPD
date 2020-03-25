@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Introduzca los datos del Nuevo Responsable</div>
                <div>

                            {{--<td>{{$paciente['1']}}</td>--}}
                </div>
            </div>
            <div class="panel-body">
                {!! Form::open(['route' => 'responsable.store', 'class'=>'form-inline']) !!}
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
                                {!! Form::label('direccion', 'Dirección') !!}
                            </td>
                            <td width="500">
                                {!! Form::text('direccion',null,['class'=>'form-control', 'autofocus']) !!}
                            </td>
                        </div>
                    </tr>
                    <tr>
                    </tr>
                    <tr>
                        <div class="form-group">
                            <td width="500" >
                                {!! Form::label('parentesco', 'Relacion') !!}
                            </td>
                            <td width="500">
                                {!! Form::text('parentesco',null,['class'=>'form-control', 'autofocus']) !!}
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
                </div>
            @endsection



