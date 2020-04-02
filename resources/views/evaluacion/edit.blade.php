@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Editar Tratamiento</div>

                </div>
                <div class="panel-body">
                    {!! Form::model($tratamiento, [ 'route' => ['tratamiento.update',$tratamiento->id], 'method'=>'PUT', 'class'=>'form-inline']) !!}
                    <table id="datosPersonales" width="600" >
                        <tr>
                            <div class="form-group">
                                <td width="500" >
                                    {!! Form::label('medicamento', 'Medicamento ') !!}
                                </td>
                                <td width="500">
                                    {!! Form::text('medicamento',$tratamiento->medicamento,['class'=>'form-control', 'required', 'autofocus']) !!}
                                </td>
                            </div>
                        </tr>
                        <tr>
                            <div class="form-group">
                                <td width="500" >
                                    {!! Form::label('dosis', 'Dosis ') !!}
                                </td>
                                <td width="500">
                                    {!! Form::text('dosis',$tratamiento->dosis,['class'=>'form-control', 'required', 'autofocus']) !!}
                                </td>
                            </div>
                        </tr>
                        <tr>
                            <div class="form-group">
                                <td width="500" >
                                    {!! Form::label('frecuencia', 'Frecuencia diaria ') !!}
                                </td>
                                <td width="500">
                                    {!! Form::text('frecuencia',$tratamiento->frecuencia,['class'=>'form-control', 'required', 'autofocus']) !!}
                                </td>
                            </div>
                        </tr>
                        <tr>
                            <div class="form-group">
                                <td width="500" >
                                    {!! Form::label('fechainicio', 'Fecha de Inicio ') !!}
                                </td>
                                <td width="500">
                                    {!! Form::date('fechainicio',$tratamiento->fechainicio,['class'=>'form-control', 'autofocus']) !!}
                                </td>
                            </div>
                        </tr>
                        <tr>
                            <div class="form-group">
                                <td width="500" >
                                    {!! Form::label('fechafin', 'Fecha de Fin ') !!}
                                </td>
                                <td width="500">
                                    {!! Form::date('fechafin',$tratamiento->fechafin,['class'=>'form-control', 'autofocus']) !!}
                                </td>
                            </div>
                        </tr>
                        <tr>
                            <div class="form-group">
                                <td width="500" >
                                    {!! Form::label('detalles', 'Detalles ') !!}
                                </td>
                                <td width="500">
                                    {!! Form::textarea('detalles',$tratamiento->detalles,['class'=>'form-control', 'required', 'autofocus']) !!}
                                </td>
                            </div>
                        </tr>


                        <tr>
                            {{  Form::hidden('url',URL::previous())  }}
                        </tr>
                    </table>
                    {!! Form::submit('Guardar',['class'=>'btn-primary btn']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection




