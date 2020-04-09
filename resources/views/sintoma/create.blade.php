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
                        <select id="nombre" name="nombre" >
                            <option value="" disabled selected>Seleccione síntoma</option>
                            <optgroup label="Motores">
                                @foreach (config('enumSintomas.Motores') as $sintomaMotor)
                                    <option>{{$sintomaMotor}}</option>
                                @endforeach
                            </optgroup>
                            <optgroup label="No Motores">
                                @foreach (array_keys(config('enumSintomas.No_Motores')) as $catNoMotor)
                                    <optgroup label="{{$catNoMotor}}">
                                        @foreach(config('enumSintomas.No_Motores.'.$catNoMotor) as $valNoMotor)
                                            <option>{{$valNoMotor}}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </optgroup>
                        </select>
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




