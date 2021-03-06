@extends('layouts.app')

@section('content')
    @if(count($errors))
        <div class="form-group">
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
    <div class="container">
        {!! Form::model($sintoma, [ 'route' => ['sintoma.update',$sintoma->id], 'method'=>'PUT', 'class'=>'form-inline']) !!}
        <div class="row">
            <div >
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="floatLeft">

                            <h4>Modificar síntoma {{$sintoma->nombre}} de {{$sintoma->paciente->getFullsurnameAttribute()}}</h4>
                            <hr/>
                            <table class="table table-striped table-bordered">

                                <tr>
                                    <div class="form-group">
                                        <div class="panel-body">
                                            {!! Form::open(['route' => 'sintoma.store', 'class'=>'form-inline']) !!}
                                            <div class="form-group">
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

                            {{  Form::hidden('url',URL::previous())  }}

                            {!! Form::submit('Guardar',['class'=>'btn-primary btn']) !!}
                            {!! Form::close() !!}
                            <a href={{ url('/sintoma/index/'.$sintoma->paciente->id) }} class="btn btn-info">Volver</a>


                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection