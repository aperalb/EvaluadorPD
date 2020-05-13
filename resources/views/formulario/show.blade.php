@extends('layouts.app')
@if ($mensaje ?? ''!=null)
    <div class="alert alert-success">
        <ul>
            <li>{{$mensaje ?? ''}}</li>
        </ul>
    </div>
@endif
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
        @if(Auth::User()->showRol()=='MEDICO')
            {!! Form::open(['route' =>['formulario.update',$formulario->id,$evaluacion->id], 'method'=>'PUT','enctype'=>'multipart/form-data']) !!}
        @endif
        <div class="row justify-content-center">
            <div style="width: 100%;text-align: center">
                <h3><b>{{$formulario->nombre }}</b></h3>
                <div>
                    <h4>{{'Paciente: '.$evaluacion->paciente->user->getFullsurnameAttribute()}}</h4>
                </div>
                <hr>

            </div>
            <div class="col-md-8">

                @foreach($respuestas as $respuesta)

                    <table class="table table-active" style="border-spacing: 20px 10px; background-color: #e4eeee ">
                        <tr>
                            <td><h4><pre style="text-align:justify;white-space: pre-line;" >{{$respuesta->pregunta->titulo}}</pre></h4></td>
                        </tr>
                        <tr>
                            <td width="50%"><pre style="text-align:justify;white-space: pre-line;" >{{$respuesta->pregunta->enunciado}}</pre></td>
                        </tr>
                        <tr>
                            @if($respuesta->pregunta->tiporespuesta == "numerico")
                                @php
                                    $bottom = 0;
                                    $top = 0;
                                    $array = mb_split('-',$respuesta->pregunta->rango);
                                    $bottom = $array[0];
                                    $top = $array[1];
                                @endphp


                                <td>

                                    @if(Auth::User()->showRol()=='MEDICO')
                                        <div style="display: inline">
                                            <label style="font-size:17px; display: inline;">
                                                Respuesta:
                                                @for ($i = $bottom; $i <= $top; $i++)
                                                    @if($i==$respuesta->valor)

                                                        <input type="radio"  name="{{$respuesta->pregunta->id}}"id="{{$respuesta->pregunta->id}}" value="{{$i}}" checked style="height:15px; width:15px; ">{{$i}}

                                                    @else
                                                        <input type="radio" name="{{$respuesta->pregunta->id}}"id="{{$respuesta->pregunta->id}}" value="{{$i}}" style="height:15px; width:15px;">{{$i}}
                                                    @endif

                                                @endfor
                                            </label>
                                        </div>
                                    @else
                                        <div style="display: inline">
                                            <label style="font-size:17px; display: inline;">
                                                Respuesta:
                                                @for ($i = $bottom; $i <= $top; $i++)
                                                    @if($i==$respuesta->valor)

                                                        <input type="radio" disabled='disabled' name="{{$respuesta->pregunta->id}}"id="{{$respuesta->pregunta->id}}" value="{{$i}}" checked style="height:15px; width:15px; ">{{$i}}

                                                    @else
                                                        <input type="radio" disabled='disabled' name="{{$respuesta->pregunta->id}}"id="{{$respuesta->pregunta->id}}" value="{{$i}}" style="height:15px; width:15px;">{{$i}}
                                                    @endif

                                                @endfor
                                            </label>
                                        </div>


                                    @endif



                                </td>
                            @else
                                <td>
                                    <div style="display: inline">
                                        <a>  <pre>{!! Form::textarea($respuesta->pregunta->id,$respuesta->valor,['class'=>'form-control', 'autofocus',' cols="80" rows="10"']) !!}</pre></a>
                                    </div>
                                </td>
                            @endif

                        </tr>
                    </table>
                @endforeach
                <br>

            </div>

        </div>

        <div style="align-content: center;display: inline; margin-left: 17%">
            @if(Auth::User()->showRol()=='MEDICO')
                {!! Form::submit('Actualizar',['class'=> 'btn btn-success','onClick'=>'return confirm("¿Seguro que deseas editar esta resolución?");']) !!}
                {!! Form::close() !!}
            @endif

            <a href={{ url('/evaluacion/'.$evaluacion->id) }} class="btn btn-info" >Volver</a>
        </div>

    </div>

@endsection
