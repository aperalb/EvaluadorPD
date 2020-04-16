@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h4>{{'Nueva resolución del formulario '.$formulario->nombre }}</h4>
                {{--<table class="table table-striped table-bordered">--}}
                <tr>
                    <td colspan="10">Formularios disponibles</td>
                </tr>

                @foreach($preguntas as $pregunta)
                    <table>
                        <tr>
                            <td><h5><pre style="text-align:justify;white-space: pre-line;" >{{$pregunta->titulo}}</pre></h5></td>
                        </tr>
                        <tr>
                            <td width="50%"><pre style="text-align:justify;white-space: pre-line;" >{{$pregunta->enunciado}}</pre></td>
                        </tr>
                        {{--Segun el tipo de la pregunta, sacamos un input de respuesta--}}
                        @if($pregunta->tiporespuesta == 'numerico')
                            {{--Si el tipo de la respuesta es numerico, se procesa el rango y se sacan los inputs determinados--}}
                        <tr>
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
                        </tr>

                        @else <td>
                                <div style="display: inline">
                                    <a>  <pre>{!! Form::textarea($pregunta->id,null,['class'=>'form-control', 'autofocus',' cols="80" rows="10"']) !!}</pre></a>
                                </div>
                        @endif
                        <hr/>
                    </table>
                @endforeach
                {{--</table>--}}

            </div>
        </div>
    </div>
@endsection







