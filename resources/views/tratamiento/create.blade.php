@extends('layouts.app')

@section('content')

    <h4 style="margin-left: 40%">Crear tratamiento</h4>

    <hr>
    
    <div style="display:block; width:100%">

        <div style="float: left; width: 45%; margin-left: 3%">
            {!! Form::open(['route' => 'tratamiento.store', 'class'=>'form-inline']) !!}

            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Categoría

                        <select name="categorias" id="categorias" style="margin-left: 10%; width: 40%">
                            <option value="">Todas</option>
                            @foreach($categorias as $categoria)
                                <option value="{{$categoria}}">{{$categoria}}</option>
                            @endforeach
                        </select>
                    </th>
                    <th>Nombre
                        <input id="tableSearch" type="text"
                               placeholder="Filtro nombre" style="margin-left: 10%; width: 40%">
                    </th>
                    <th>Seleccionar
                    </th>

                    <th>Descripción</th>

                </tr>
                </thead>
                <tbody id="myTable">
                @foreach($medicamentos as $medicamento)
                    <tr>
                        <td id="search">{{$medicamento->categoria}}</td>
                        <td id="search">{{$medicamento->nombre}}</td>
                        <td><a class="btn btn-info"
                               href="javascript:ventanaSecundaria('/medicamento/show/{{$medicamento->id}}')">Ver Mas</a>
                        </td>
                        <td><input type="radio" name="medicamentoSelect" id="medicamentoSelect"
                                   value="{{$medicamento->id}}" required style="height:15px; width:15px; ">
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>

        <div style="float:right; width: 45%">

            <table id="datosPersonales" width="600" class="table table-striped table-bordered">
                <tr>
                    <div class="form-group">
                        <th width="500">
                            {!! Form::label('medicamento', 'Medicamento ') !!}
                        </th>
                        <td width="500">
                            {!! Form::text('medicamento',null,['class'=>'form-control', 'required', 'autofocus']) !!}
                        </td>
                    </div>
                </tr>
                <tr>
                    <div class="form-group">
                        <th width="500">
                            {!! Form::label('dosis', 'Dosis ') !!}
                        </th>
                        <td width="500">
                            {!! Form::number('dosis',null,['class'=>'form-control', 'required', 'autofocus','step' => '0.1']) !!}
                        </td>
                    </div>
                </tr>
                <tr>
                    <div class="form-group">
                        <th width="500">
                            {!! Form::label('frecuencia', 'Frecuencia Diaria ') !!}
                        </th>
                        <td width="500">
                            {!! Form::number('frecuencia',null,['class'=>'form-control', 'required', 'autofocus']) !!}
                        </td>
                    </div>
                </tr>
                <tr>
                    <div class="form-group">
                        <th width="500">
                            {!! Form::label('fechainicio', 'Fecha de Inicio ') !!}
                        </th>
                        <td width="500">
                            {!! Form::date('fechainicio',null,['class'=>'form-control', 'autofocus']) !!}
                        </td>
                    </div>
                </tr>
                <tr>
                    <div class="form-group">
                        <th width="500">
                            {!! Form::label('fechafin', 'Fecha de Fin ') !!}
                        </th>
                        <td width="500">
                            {!! Form::date('fechafin',null,['class'=>'form-control', 'autofocus']) !!}
                        </td>
                    </div>
                </tr>
                <tr>
                    <div class="form-group">
                        <th width="500">
                            {!! Form::label('detalles', 'Detalles ') !!}
                        </th>
                        <td width="500">
                            {!! Form::textarea('detalles',null,['class'=>'form-control', 'autofocus']) !!}
                        </td>
                    </div>
                </tr>


                <div class="form-group">

                    {!! Form::hidden('pacienteID', $pacienteID) !!}</td>
                </div>

            </table>
            <table>
                <td>
                    {!! Form::submit('Guardar',['class'=>'btn-primary btn']) !!}
                    {!! Form::close() !!}
                </td>
                <td>{{'              '}}</td>
                <td>
                    <a href={{ url('/paciente/'.$pacienteID) }} class="btn btn-info">Volver</a>
                </td>
            </table>

            </td>

        </div>

@endsection







