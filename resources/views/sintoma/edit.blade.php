@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Editar Tratamiento</div>

                </div>
                <div class="panel-body">
                    {!! Form::model($sintoma, [ 'route' => ['sintoma.update',$sintoma->id], 'method'=>'PUT', 'class'=>'form-inline']) !!}
                    <table id="datosPersonales" width="600" >
                        <tr>
                            <div class="form-group">
                                <td width="500" >
                                    {!! Form::label('nombre', 'Sintoma ') !!}
                                </td>
                                <td width="500">
                                    {!! Form::select('nombre', array_merge(config('enumSintomas.Motores'),config('enumSintomas.No_Motores')),array_search($sintoma->nombre,array_merge(config('enumSintomas.Motores'),config('enumSintomas.No_Motores'))),['class'=>'form-control', 'required', 'autofocus']) !!}
                                </td>
                            </div>
                        </tr>
                        <tr>
                            <div class="form-group">
                                <td width="500" >
                                    {!! Form::label('descripcion', 'descripcion ') !!}
                                </td>
                                <td width="500">
                                    {!! Form::text('descripcion',$sintoma->descripcion,['class'=>'form-control', 'required', 'autofocus']) !!}
                                </td>
                            </div>
                        </tr>
                        <tr>
                            <div class="form-group">
                                <td width="500" >
                                    {!! Form::label('detalles', 'Detalles ') !!}
                                </td>
                                <td width="500">
                                    {!! Form::text('detalles',$sintoma->detalles,['class'=>'form-control', 'required', 'autofocus']) !!}
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




