@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Introduzca los datos del Nuevo Síntoma</div>

                </div>
                <div class="panel-body">
                    {!! Form::open(['route' => 'sintoma.store', 'class'=>'form-inline']) !!}
                    <div class="form-group">
                        <td width="500">
                            {!! Form::label('nombre', 'Nombre') !!}
                        </td>
                        <td width="500">
                            {!! Form::select('nombre', array_merge(config('enumSintomas.Motores'),config('enumSintomas.No_Motores')),['class'=>'form-control', 'required', 'autofocus']) !!}
                        </td>
                    </div>
                    <tr>
                        <div class="form-group">
                            <td width="500" >
                                {!! Form::label('descripcion', 'Descripción ') !!}
                            </td>
                            <td width="500">
                                {!! Form::text('descripcion',null,['class'=>'form-control', 'required', 'autofocus']) !!}
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




