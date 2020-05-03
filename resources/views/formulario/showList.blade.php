@extends('layouts.app')
@section('content')

    <div class="container">

        <div class="row justify-content-center">
            <div >
                <h3><b>{{$formulario->nombre }}</b></h3>
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
                                                <input type="radio" disabled='disabled' name="{{$pregunta->id}}"id="{{$pregunta->id}}" value="{{$i}}"  style="height:15px; width:15px; ">{{$i}}

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
                <br>

                <div style="align-content: center;display: inline;">
                    <a href="#nuevapregunta" class="btn btn-success" onclick="muestraFormulario()" >Añadir Pregunta</a>
                    <a href={{ url('/formulario/index') }} class="btn btn-info" >Volver</a>
                </div>

                    <div class="nuevapregunta" id="nuevoFormulario" style="visibility: hidden">
                    <br>
                    <table class="table table-active" style="border-spacing: 20px 10px; background-color: #e4eeee ">
                        <tr>
                            <th>
                                {!! Form::open([ 'route' => ['formulario.edit',$formulario->id], 'method'=>'POST', 'class'=>'form-inline']) !!}
                            </th>
                        </tr>
                        <tr>
                            <th><label for="tituloCreate">Titulo</label> </th>
                        </tr>
                        <tr>
                            <td><h4><pre style="text-align:justify;white-space: pre-line;" ><input type="text" id="tituloCreate" name="tituloCreate" style="width: 100%; box-sizing: border-box;-webkit-box-sizing:border-box;-moz-box-sizing: border-box;"></pre></h4></td>
                        </tr>
                        <tr>
                            <th><label for="enunciadoCreate">Enunciado</label> </th>
                        </tr>
                        <tr>
                            <td>

                     <pre>
                         <textarea class="form-control" name="enunciadoCreate" required id="enunciadoCreate" rows="8" style="width: 100%; box-sizing: border-box;-webkit-box-sizing:border-box;-moz-box-sizing: border-box;"></textarea>
                     </pre>

                            </td>
                        </tr>
                        <tr>
                            <th><label for="rangoCreate">Rango Respuestas</label> </th>
                        </tr>
                        <tr>
                            <td>
                                <div class="number-input md-number-input">
                                    <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="minus"></button>
                                    <input class="quantity" min="1" name="rangoCreate" value="1" type="number">
                                    <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"></button>

                                </div>
                                <br>
                                <a href='#nuevapregunta' class="btn-primary btn"  onclick='ocultaFormulario()'>Cancelar</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {{--{!! Form::submit('Guardar',['class'=>'btn-primary btn']) !!}--}}
                                {{--{!! Form::close() !!}--}}
                            </td>
                        </tr>
                    </table>
                </div>

            </div>
        </div>



    </div>

    <script type="text/javascript">
        function muestraFormulario() {

            var x = document.getElementById('nuevoFormulario');
            x.setAttribute('style',"");
        }

        function ocultaFormulario() {

            var x = document.getElementById('nuevoFormulario');
            x.setAttribute('style',"visibility:hidden");
        }

    </script>

    <style type="text/css">
        input[type="number"] {
            -webkit-appearance: textfield;
            -moz-appearance: textfield;
            appearance: textfield;
        }
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
        }

        .number-input button {
            -webkit-appearance: none;
            background-color: transparent;
            border: none;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            margin: 0;
            position: relative;
        }
        .number-input button:before,
        .number-input button:after {
            display: inline-block;
            position: absolute;
            content: '';
            height: 2px;
            transform: translate(-50%, -50%);
        }
        .number-input button.plus:after {
            transform: translate(-50%, -50%) rotate(90deg);
        }
        .number-input input[type=number] {
            text-align: center;
        }


        .md-number-input.number-input {
            border: 2px solid #ddd;
            width: 11.8rem;
        }
        .md-number-input.number-input button {
            outline: none;
            width: 3rem;
            height: 2rem;
            padding-top: .8rem;
        }


        .md-number-input.number-input button:before,
        .md-number-input.number-input button:after {
            width: 1rem;
            background-color: #212121;
        }
        .md-number-input.number-input input[type=number] {
            max-width: 5rem;
            padding: .5rem;
            border: solid #ddd;
            border-width: 0 2px;
            font-size: 1.2rem;
            height: 2.3rem;
            font-weight: bold;
            outline: none;
        }
        @media not all and (min-resolution:.001dpcm)
        { @supports (-webkit-appearance:none) and (stroke-color:transparent) {
            .number-input.md-number-input.safari_only button:before,
            .number-input.md-number-input.safari_only button:after {
                margin-top: -.6rem;
            }
        }}
    </style>
@endsection








