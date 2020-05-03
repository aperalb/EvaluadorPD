@extends('layouts.app')

@section('content')
    <div class="container">
        {!! Form::open(['route' =>['formulario.altaFormulario', 'method'=>'POST','class'=>'form-inline','enctype'=>'multipart/form-data']]) !!}


        <div>
            <table class="table-striped bordered" width="100%">
                <tr>
                    <h3>
                        <label for="idFormulario">Título del nuevo Formulario</label>
                        <input type="text" id="idFormulario" size="83%" name="nombreFormulario">
                    </h3>
                    <br>
                </tr>
                <tr>
                    <label for="idDescripcion">Introduzca la descripción</label>
                    <pre>
                        <textarea class="form-control" size="83%" id="idDescripcion" rows="4"></textarea>
                    </pre>
                </tr>
            </table>
            <br>

            <table class="table-bordered" id="tablaPregunta">
                <tr>

                </tr>
            </table>

        </div>
    </div>
@endsection







