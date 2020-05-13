@extends('layouts.app')
@if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif
@if (\Session::has('danger'))
    <div class="alert alert-danger">
        <ul>
            <li>{!! \Session::get('danger') !!}</li>
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

        <div class="row justify-content-center">
            <div style="width: 100%; text-align: center">
                <h3><b>{{$formulario->nombre }}</b></h3>
                <hr>

            </div>
            <div class="col-md-8">

                @foreach($preguntas as $pregunta)


                    <table class="table table-active" style="border-spacing: 20px 10px; background-color: #e4eeee ">
                        {!! Form::model($pregunta, [ 'route' => ['pregunta.update',$pregunta->id], 'method'=>'PUT', 'class'=>'form-inline']) !!}
                        <tr>
                            <td id="preguntaTituloOriginal{{$pregunta->id}}"><h4><pre style="text-align:justify;white-space: pre-line;" >{{$pregunta->titulo}}</pre></h4></td>
                            <td id="preguntaTituloNuevo{{$pregunta->id}}" style="display:none"><h4><pre style="text-align:justify;white-space: pre-line;" >
                                        <input type="text" value="{{$pregunta->titulo}}" id="tituloNuevo" name="tituloCreate" style="width: 100%; box-sizing: border-box;-webkit-box-sizing:border-box;-moz-box-sizing: border-box;"></pre></h4></td>
                        </tr>
                        <tr>
                            <td id="preguntaEnunciadoOriginal{{$pregunta->id}}" width="50%"><pre style="text-align:justify;white-space: pre-line;" >{{$pregunta->enunciado}}</pre></td>
                            <td id="preguntaEnunciadoNuevo{{$pregunta->id}}" style="display: none" width="50%"><pre style="text-align:justify;white-space: pre-line;" >

                                   <textarea class="form-control" name="enunciadoCreate" required id="enunciadoCreate" rows="8" style="width: 100%; box-sizing: border-box;-webkit-box-sizing:border-box;-moz-box-sizing: border-box;">{{$pregunta->enunciado}}</textarea>

                                </pre></td>
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
                                    <div id = "preguntaRangoOriginal{{$pregunta->id}}" style="display: inline";>
                                        <label style="font-size:17px; display: inline;">
                                            Respuesta:
                                            @for ($i = $bottom; $i <= $top; $i++)
                                                <input type="radio" disabled='disabled' name="{{$pregunta->id}}"id="{{$pregunta->id}}" value="{{$i}}"  style="height:15px; width:15px; ">{{$i}}

                                            @endfor
                                        </label>
                                    </div>
                                    <div id="preguntaRangoNuevo{{$pregunta->id}}" style="display: none;">
                                        <p>La cota inferior es siempre cero. Ej: Si indica 3 las posibles respuestas serán 0 1 2 y 3</p>
                                        <div class="number-input md-number-input">

                                            <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="minus"></button>
                                            <input class="quantity" min="1" name="rangoCreate" value="{{$top}}" type="number">
                                            <button type="button"  onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"></button>

                                        </div>
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
                        <tr>
                            <td>
                                <a id="botonEditaPregunta{{$pregunta->id}}" href="#botonEditaPregunta{{$pregunta->id}}" class="btn btn-info" onclick="editaPregunta({{$pregunta->id}})" >Editar</a>
                                {!! Form::submit('Guardar',['style'=>'display:none','id'=>'botonGuardaPregunta'.$pregunta->id,'class'=>'btn-success btn']) !!}
                                {!! Form::close() !!}
                                <a id="botonCancelarEditaPregunta{{$pregunta->id}}" style="display: none;" href="#botonCancelarEditaPregunta{{$pregunta->id}}" class="btn btn-secondary" onclick="CancelarEditaPregunta({{$pregunta->id}})" >Cancelar</a>

                                {!! Form::open(['route' => ['pregunta.destroy',$pregunta->id], 'method' => 'delete']) !!}
                                {!! Form::submit('Eliminar', ['style'=>"margin-top: 1%",'class'=> 'btn btn-danger','onClick'=>'return confirm("¿Seguro que deseas eliminar esta pregunta?");'])!!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    </table>
                @endforeach
                <br>

                <div style="align-content: center;display: inline;">
                    <a href="#nuevapregunta" class="btn btn-primary" onclick="muestraFormulario()" >Añadir Pregunta</a>
                    <a href={{ url('/formulario/index') }} class="btn btn-secondary" >Volver</a>
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
                            <td><h4><pre style="text-align:justify;white-space: pre-line;" ><input type="text" id="tituloCreate" name="tituloCreate" style="width: 100%; box-sizing: border-box;-webkit-box-sizing:border-box;-moz-box-sizing: border-box;" required></pre></h4></td>
                        </tr>
                        <tr>
                            <th><label for="enunciadoCreate">Enunciado</label> </th>
                        </tr>
                        <tr>
                            <td>

                     <pre>
                         <textarea class="form-control" name="enunciadoCreate" required id="enunciadoCreate" rows="8" style="width: 100%; box-sizing: border-box;-webkit-box-sizing:border-box;-moz-box-sizing: border-box;" required></textarea>
                     </pre>

                            </td>
                        </tr>
                        <tr>
                            <th><label for="rangoCreate">Rango Respuestas (Cota Superior)</label> </th>
                        </tr>
                        <tr>
                            <td>
                                <p>La cota inferior es siempre cero. Ej: Si indica 3 las posibles respuestas serán 0 1 2 y 3</p>
                                <div class="number-input md-number-input">

                                    <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="minus"></button>
                                    <input class="quantity" min="1" name="rangoCreate" value="1" type="number">
                                    <button type="button"  onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"></button>

                                </div>
                                <br>
                                {!! Form::submit('Guardar',['class'=>'btn-success btn']) !!}
                                {!! Form::close() !!}

                                <a href='#nuevapregunta' class="btn btn-secondary"  onclick='ocultaFormulario()'>Cancelar</a>
                            </td>
                        </tr>
                        <tr>
                            <td>

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

        function editaPregunta(idElemento) {

            var a =  document.getElementById('preguntaTituloNuevo'+idElemento);
            var b =  document.getElementById('preguntaEnunciadoNuevo'+idElemento);
            var c =  document.getElementById('preguntaRangoNuevo'+idElemento);
            var d =  document.getElementById('preguntaTituloOriginal'+idElemento);
            var e =  document.getElementById('preguntaEnunciadoOriginal'+idElemento);
            var f =  document.getElementById('preguntaRangoOriginal'+idElemento);
            var g =  document.getElementById('botonGuardaPregunta'+idElemento);
            var h =  document.getElementById('botonCancelarEditaPregunta'+idElemento);
            var i =  document.getElementById('botonEditaPregunta'+idElemento);

            a.setAttribute('style',"display:");
            b.setAttribute('style',"display:");
            c.setAttribute('style',"display:");
            d.setAttribute('style',"display:none");
            e.setAttribute('style',"display:none");
            f.setAttribute('style',"display:none");
            g.setAttribute('style',"display:");
            h.setAttribute('style',"display:");
            i.setAttribute('style',"display:none");
        }

        function CancelarEditaPregunta(idElemento){
            var a =  document.getElementById('preguntaTituloNuevo'+idElemento);
            var b =  document.getElementById('preguntaEnunciadoNuevo'+idElemento);
            var c =  document.getElementById('preguntaRangoNuevo'+idElemento);
            var d =  document.getElementById('preguntaTituloOriginal'+idElemento);
            var e =  document.getElementById('preguntaEnunciadoOriginal'+idElemento);
            var f =  document.getElementById('preguntaRangoOriginal'+idElemento);
            var g =  document.getElementById('botonGuardaPregunta'+idElemento);
            var h =  document.getElementById('botonCancelarEditaPregunta'+idElemento);
            var i =  document.getElementById('botonEditaPregunta'+idElemento);

            a.setAttribute('style',"display:none");
            b.setAttribute('style',"display:none");
            c.setAttribute('style',"display:none");
            d.setAttribute('style',"display:");
            e.setAttribute('style',"display:");
            f.setAttribute('style',"display:");
            g.setAttribute('style',"display:none");
            h.setAttribute('style',"display:none");
            i.setAttribute('style',"display:");

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








