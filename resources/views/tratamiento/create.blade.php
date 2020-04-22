@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h4>Crear tratamiento</h4>

                <hr>
                <div class="panel-body">
                    {!! Form::open(['route' => 'tratamiento.store', 'class'=>'form-inline']) !!}
                    <table id="datosPersonales" width="600" class="table table-striped table-bordered">
                        <tr>
                            <div class="form-group">
                                <th width="500" >
                                    {!! Form::label('medicamento', 'Medicamento ') !!}
                                </th>
                                <td width="500">
                                    {!! Form::text('medicamento',null,['class'=>'form-control', 'required', 'autofocus']) !!}
                                </td>
                            </div>
                        </tr>
                        <tr>
                            <div class="form-group">
                                <th width="500" >
                                    {!! Form::label('dosis', 'Dosis ') !!}
                                </th>
                                <td width="500">
                                    {!! Form::number('dosis',null,['class'=>'form-control', 'required', 'autofocus','step' => '0.1']) !!}
                                </td>
                            </div>
                        </tr>
                        <tr>
                            <div class="form-group">
                                <th width="500" >
                                    {!! Form::label('frecuencia', 'Frecuencia Diaria ') !!}
                                </th>
                                <td width="500">
                                    {!! Form::number('frecuencia',null,['class'=>'form-control', 'required', 'autofocus']) !!}
                                </td>
                            </div>
                        </tr>
                        <tr>
                            <div class="form-group">
                                <th width="500" >
                                    {!! Form::label('fechainicio', 'Fecha de Inicio ') !!}
                                </th>
                                <td width="500">
                                    {!! Form::date('fechainicio',null,['class'=>'form-control', 'autofocus']) !!}
                                </td>
                            </div>
                        </tr>
                        <tr>
                            <div class="form-group">
                                <th width="500" >
                                    {!! Form::label('fechafin', 'Fecha de Fin ') !!}
                                </th>
                                <td width="500">
                                    {!! Form::date('fechafin',null,['class'=>'form-control', 'autofocus']) !!}
                                </td>
                            </div>
                        </tr>
                        <tr>
                            <div class="form-group">
                                <th width="500" >
                                    {!! Form::label('detalles', 'Detalles ') !!}
                                </th>
                                <td width="500">
                                    {!! Form::textarea('detalles',null,['class'=>'form-control', 'autofocus']) !!}
                                </td>
                            </div>
                        </tr>



                        <div class="form-group">

                            {!! Form::hidden('pacienteID', $pacienteID) !!}</td>
                        </div>

                    </table>
                    <table>
                        <td>
                        {!! Form::submit('Guardar',['class'=>'btn-primary btn']) !!}
                        {!! Form::close() !!}
                        </td>
                        <td>{{'              '}}</td>
                        <td>
                            <a href={{ url('/paciente/'.$pacienteID) }} class="btn btn-info">Volver</a>
                        </td>
                    </table>

                   </td>
                </div>
            </div>
        </div>
    </div>
@endsection







