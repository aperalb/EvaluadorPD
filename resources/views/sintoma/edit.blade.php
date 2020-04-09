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
                                    <select id="sintoma" name="nombre">
                                        <option value="" disabled selected>Seleccione síntoma</option>
                                        <optgroup label="Motores">
                                            @foreach (config('enumSintomas.Motores') as $sintomaMotor)
                                                @if($sintomaMotor == $sintoma->nombre)
                                                    <option selected>{{$sintomaMotor}}</option>
                                                @else
                                                    <option >{{$sintomaMotor}}</option>
                                                @endif
                                            @endforeach
                                        </optgroup>
                                        <optgroup label="No Motores">
                                            @foreach (array_keys(config('enumSintomas.No_Motores')) as $catNoMotor)
                                                <optgroup label="{{$catNoMotor}}">
                                                    @foreach(config('enumSintomas.No_Motores.'.$catNoMotor) as $valNoMotor)
                                                        @if($valNoMotor == $sintoma->nombre)
                                                            <option selected>{{$valNoMotor}}</option>
                                                        @else
                                                            <option >{{$valNoMotor}}</option>
                                                        @endif
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                        </optgroup>
                                    </select>


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
