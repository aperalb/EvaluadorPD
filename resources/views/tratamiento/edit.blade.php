@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <h4>Editar tratamiento</h4>

                <hr>
                <div class="panel-body">
                    {!! Form::model($tratamiento, [ 'route' => ['tratamiento.update',$tratamiento->id], 'method'=>'PUT', 'class'=>'form-inline']) !!}
                    <table id="datosPersonales" width="600" class="table table-striped table-bordered">
                        <tr>
                            <div class="form-group">
                                <th width="500" >
                                    {!! Form::label('medicamento', 'Medicamento ') !!}
                                </th>
                                <td width="500">
                                    {!! Form::text('medicamento',$tratamiento->medicamento,['class'=>'form-control', 'required', 'autofocus']) !!}
                                </td>
                            </div>
                        </tr>
                        <tr>
                            <div class="form-group">
                                <th width="500" >
                                    {!! Form::label('dosis', 'Dosis ') !!}
                                </th>
                                <td width="500">
                                    {!! Form::number('dosis',$tratamiento->dosis,['class'=>'form-control', 'required', 'autofocus','step' => '0.1']) !!}
                                </td>
                            </div>
                        </tr>
                        <tr>
                            <div class="form-group">
                                <th width="500" >
                                    {!! Form::label('frecuencia', 'Frecuencia diaria ') !!}
                                </th>
                                <td width="500">
                                    {!! Form::number('frecuencia',$tratamiento->frecuencia,['class'=>'form-control', 'required', 'autofocus']) !!}
                                </td>
                            </div>
                        </tr>
                        <tr>
                            <div class="form-group">
                                <th width="500" >
                                    {!! Form::label('fechainicio', 'Fecha de Inicio ') !!}
                                </th>
                                <td width="500">
                                    {!! Form::date('fechainicio',$tratamiento->fechainicio,['class'=>'form-control', 'autofocus']) !!}
                                </td>
                            </div>
                        </tr>
                        <tr>
                            <div class="form-group">
                                <th width="500" >
                                    {!! Form::label('fechafin', 'Fecha de Fin ') !!}
                                </th>
                                <td width="500">
                                    {!! Form::date('fechafin',$tratamiento->fechafin,['class'=>'form-control', 'autofocus']) !!}
                                </td>
                            </div>
                        </tr>
                        <tr>
                            <div class="form-group">
                                <th width="500" >
                                    {!! Form::label('detalles', 'Detalles ') !!}
                                </th>
                                <td width="500">
                                    {!! Form::textarea('detalles',$tratamiento->detalles,['class'=>'form-control', 'autofocus']) !!}
                                </td>
                            </div>
                        </tr>


                        <tr>
                            {{  Form::hidden('url',URL::previous())  }}
                        </tr>
                    </table>
                    <table>
                        <td>
                            {!! Form::submit('Guardar',['class'=>'btn-primary btn']) !!}
                            {!! Form::close() !!}
                        </td>
                        <td>{{'              '}}</td>
                        <td>
                            <a href={{ url('/paciente/'.$tratamiento->paciente->id) }} class="btn btn-info">Volver</a>
                        </td>
                    </table>
            </div>
        </div>
    </div>
@endsection






