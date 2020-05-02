@extends('layouts.app')

@section('content')
    <div class="container">
        {!! Form::open(['route' =>['formulario.store',$formulario->id,$evaluacion->id], 'method'=>'POST','class'=>'form-inline','enctype'=>'multipart/form-data']) !!}

        <div class="row justify-content-center">
            <div >
                <h3><b>{{$formulario->nombre }}</b></h3>
                <div style="text-align: right">
                    <h4>{{'Paciente: '.$evaluacion->paciente->getFullsurnameAttribute()}}</h4>
                </div>
                <hr>
            </div>
            <div class="col-md-8">

                @foreach($preguntas as $pregunta)
                    <table class="table table-active" style="border-spacing: 20px 10px; background-color: #e4eeee ">
                        <tr>
                            <td><h4><pre style="text-align:justify;white-space: pre-line;" >{{$pregunta->titulo}}</pre></h4></td>
                        </tr>
                        <tr>
                            <td width="50%"><pre style="text-align:justify;white-space: pre-line;" >{{$pregunta->enunciado}}</pre></td>
                        </tr>
                        <tr>
                            @if($pregunta->tiporespuesta == "numerico")
                                @php
                                    $bottom = 0;
                                    $top = 0;
                                    $array = mb_split('-',$pregunta->rango);
                                    $bottom = $array[0];
                                    $top = $array[1];
                                @endphp


                                <td>

                                    <div style="display: inline">
                                        <label style="font-size:17px; display: inline;">
                                            Respuesta:
                                        @for ($i = $bottom; $i <= $top; $i++)
                                                <input type="radio" name="{{$pregunta->id}}"id="{{$pregunta->id}}" value="{{$i}}" required>{{$i}}
                                        @endfor
                                        </label>
                                    </div>
                                </td>
                            @else
                                <td>
                                    <div style="display: inline">
                                        <a>  <pre>{!! Form::textarea($pregunta->id,null,['class'=>'form-control', 'autofocus',' cols="80" rows="10"']) !!}</pre></a>
                                    </div>
                                </td>
                            @endif

                        </tr>
                    </table>
                @endforeach




            </div>

        </div>

        <div style="align-content: center;display: inline; margin-left: 17%">
            {!! Form::submit('Guardar',['class'=>'btn-success btn']) !!}
            {!! Form::close() !!}


            <a href={{ url('/evaluacion/'.$evaluacion->id) }} class="btn btn-info" >Volver</a>
        </div>
        <br>

    </div>
@endsection







