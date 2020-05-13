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
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h4>Crear Medicamento</h4>

                <hr>
                <div class="panel-body">
                    {!! Form::open(['route' => 'medicamento.store', 'class'=>'form-inline']) !!}
                    <table id="datosPersonales" width="600" class="table table-striped table-bordered">
                        <tr>
                            <div class="form-group">
                                <th width="500" >
                                    {!! Form::label('categoria', 'Categoria ') !!}
                                </th>
                                <td width="500">
                                    {!! Form::select('categoriaExistente',$categorias,['class'=>'form-control', 'autofocus']) !!}
                                    <br>
                                    <br>
                                    <a> <input class="btn btn-info" type="button" id="Editar" value="Otra categoría" onclick="nuevaCategoria()"></a>
                                    {!! Form::text('categoriaNueva',null,['style'=>'display:none', 'id'=>'categoriaNueva', 'class'=>'form-control', 'autofocus']) !!}

                                </td>
                            </div>
                        </tr>

                        <tr>
                            <div class="form-group">
                                <th width="500" >
                                    {!! Form::label('nombre', 'Nombre ') !!}
                                </th>
                                <td width="500">
                                    {!! Form::text('nombre',null,['class'=>'form-control', 'required', 'autofocus','step' => '0.1']) !!}
                                </td>
                            </div>
                        </tr>
                        <tr>
                            <div class="form-group">
                                <th width="500" >
                                    {!! Form::label('descripcion', 'Descripcion') !!}
                                </th>
                                <td width="500">
                                    {!! Form::textarea('descripcion',null,['class'=>'form-control', 'required', 'autofocus']) !!}
                                </td>
                            </div>
                        </tr>


                        <div class="form-group">

                        </div>

                    </table>
                    <table>
                        <td>
                            {!! Form::submit('Guardar',['class'=>'btn-primary btn']) !!}
                            {!! Form::close() !!}
                        </td>
                        <td>{{'              '}}</td>
                        <td>
                            <a href={{ url('/medicamento/') }} class="btn btn-info">Volver</a>
                        </td>
                    </table>

                    </td>
                </div>
            </div>
        </div>
    </div>

<script type="application/javascript">
    function nuevaCategoria() {
        var nuevaCategoria=document.getElementById('categoriaNueva');
        nuevaCategoria.style.display="";

    }
</script>

@endsection





