@extends('layouts.app')

@section('content')
    <div class="container">
        {!! Form::open(['route' => 'sintoma.store', 'class'=>'form-inline']) !!}
        <div class="row">
            <div >
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="floatLeft">

                            <h4>Añadir Sintoma de {{$paciente->user->getFullsurnameAttribute()}}</h4>
                            <hr/>
                            <table class="table table-striped table-bordered">


                                <tr>
                                    <div class="form-group">
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
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                                <br/>



                            </table>

                            <div>
                                <h4>Detalles de la expresión del síntoma:</h4>
                                <a>  <pre>{!! Form::textarea('detalles',null,['class'=>'form-control', 'autofocus',' cols="120" rows="10"']) !!}</pre></a>
                            </div>
                            {!! Form::hidden('pacienteID', $paciente->id) !!}</td>

                            {!! Form::submit('Guardar',['class'=>'btn-primary btn']) !!}
                            {!! Form::close() !!}
                            <a href={{ url('/sintoma/index/'.$paciente->id) }} class="btn btn-info">Volver</a>


                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection