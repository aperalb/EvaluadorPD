@extends('layouts.app')

@section('content')
    <div class="container">
        {!! Form::open(['route' =>['formulario.store',$formulario->id,$evaluacion->id], 'method'=>'POST','class'=>'form-inline','enctype'=>'multipart/form-data']) !!}

        <div class="row justify-content-center">
            <div class="col-md-8">


                <h4>{{'Nueva resolución del formulario '.$formulario->nombre }}</h4>
                {{--<table class="table table-striped table-bordered">--}}

                @foreach($preguntas as $pregunta)
                    <table>
                        <tr>
                            <td><h5><pre style="text-align:justify;white-space: pre-line;" >{{$pregunta->titulo}}</pre></h5></td>
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
                                        @for ($i = $bottom; $i <= $top; $i++)
                                            @if($i==0)
                                                <input type="radio" name="{{$pregunta->id}}"id="{{$pregunta->id}}" value="{{$i}}" checked>{{$i}}

                                            @else
                                                <input type="radio" name="{{$pregunta->id}}"id="{{$pregunta->id}}" value="{{$i}}">{{$i}}
                                            @endif
                                        @endfor
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
        <br>
        {!! Form::submit('Guardar',['class'=>'btn-primary btn','style'=>'margin-left:17%;']) !!}
        {!! Form::close() !!}
    </div>
@endsection







