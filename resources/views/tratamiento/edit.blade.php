@extends('layouts.app')

@section('content')

    <h4 style="margin-left: 40%">Editar tratamiento</h4>

    <hr>

    <div style="display:block; width:100%">

        <div style="float: left; width: 45%; margin-left: 3%">
            {!! Form::model($tratamiento, [ 'route' => ['tratamiento.update',$tratamiento->id], 'method'=>'PUT', 'class'=>'form-inline']) !!}

            <table class="table table-bordered table-striped" id="medicamentosTable">
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
                        <td>
                            @if($medicamento->id == $tratamiento->medicamento_id)
                                <input onClick="cargaNombre('{{$medicamento->nombre}}')" checked type="radio"
                                       name="medicamentoSelect" id="medicamentoSelect"
                                       value="{{$medicamento->id}}" required style="height:15px; width:15px; ">
                            @else
                                <input onClick="cargaNombre('{{$medicamento->nombre}}')" type="radio"
                                       name="medicamentoSelect" id="medicamentoSelect"
                                       value="{{$medicamento->id}}" required style="height:15px; width:15px; ">
                            @endif
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
                            {!! Form::text('medicamento',$tratamiento->medicamento->nombre,['id'=>'medicamentoNombre','class'=>'form-control', 'required', 'autofocus', 'readOnly']) !!}
                        </td>
                    </div>
                </tr>
                <tr>
                    <div class="form-group">
                        <th width="500">
                            {!! Form::label('dosis', 'Dosis (mg)') !!}
                        </th>
                        <td width="500">
                            {!! Form::number('dosis',$tratamiento->dosis,['class'=>'form-control', 'required', 'autofocus','step' => '0.1']) !!}
                        </td>
                    </div>
                </tr>
                <tr>
                    <div class="form-group">
                        <th width="500">
                            {!! Form::label('frecuencia', 'Frecuencia Diaria ') !!}
                        </th>
                        <td width="500">
                            {!! Form::number('frecuencia',$tratamiento->frecuencia,['class'=>'form-control', 'required', 'autofocus']) !!}
                        </td>
                    </div>
                </tr>
                <tr>
                    <div class="form-group">
                        <th width="500">
                            {!! Form::label('fechainicio', 'Fecha de Inicio ') !!}
                        </th>
                        <td width="500">
                            {!! Form::date('fechainicio',$tratamiento->fechainicio,['class'=>'form-control', 'autofocus']) !!}
                        </td>
                    </div>
                </tr>
                <tr>
                    <div class="form-group">
                        <th width="500">
                            {!! Form::label('fechafin', 'Fecha de Fin ') !!}
                        </th>
                        <td width="500">
                            {!! Form::date('fechafin',$tratamiento->fechafin,['class'=>'form-control', 'autofocus']) !!}
                        </td>
                    </div>
                </tr>
                <tr>
                    <div class="form-group">
                        <th width="500">
                            {!! Form::label('detalles', 'Detalles ') !!}
                        </th>
                        <td width="500">
                            <pre>
                            {!! Form::textarea('detalles',$tratamiento->detalles,['class'=>'form-control', 'autofocus']) !!}
                            </pre>
                        </td>
                    </div>
                </tr>

            </table>
            <table>
                <td>
                    {!! Form::submit('Guardar',['class'=>'btn-primary btn']) !!}
                    {!! Form::close() !!}
                </td>
                <td>{{'              '}}</td>
                <td>
                    <a href={{ url('/tratamiento/index/'.$tratamiento->paciente->id) }} class="btn btn-info">Volver</a>
                </td>
            </table>

            </td>

        </div>
    </div>
    <script type="text/javascript">
        function cargaNombre(medicamentoSeleccionado) {

            var medicamentoNombre = document.getElementById('medicamentoNombre');
            medicamentoNombre.setAttribute('value', medicamentoSeleccionado);

        }

        $(document).ready(function () {

            $('#tableSearch').keyup(function () {
                // Search Text
                var search = $(this).val();
                var searchCategory = $('#categorias').val();
                // Hide all table tbody rows
                $('#medicamentosTable tbody tr').hide();

                // Count total search result
                var len = $('table tbody tr:not(.notfound) td:nth-child(2):contains("' + search + '")').length;

                if (len > 0) {
                    // Searching text in columns and show match row
                    $('table tbody tr:not(.notfound) td:nth-child(2):contains("' + search + '")').each(function () {
                        $(this).closest('tr').show();
                    });
                } else {
                    $('.notfound').show();
                }

            });


            $('#categorias').change(function () {
                // Search Text
                var search = $(this).val();

                // Hide all table tbody rows
                $('#medicamentosTable tbody tr').hide();

                // Count total search result
                var len = $('table tbody tr:not(.notfound) td:nth-child(1):contains("' + search + '")').length;

                if (len > 0) {
                    // Searching text in columns and show match row
                    $('table tbody tr:not(.notfound) td:nth-child(1):contains("' + search + '")').each(function () {
                        $(this).closest('tr').show();
                    });
                } else {
                    $('.notfound').show();
                }

            });

        });

        // Case-insensitive searching (Note - remove the below script for Case sensitive search )
        $.expr[":"].contains = $.expr.createPseudo(function (arg) {
            return function (elem) {
                return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
            };
        });

        function ventanaSecundaria(URL) {
            window.open(URL, "ventana1", "width=800,height=800,left=500,scrollbars=YES")
        }

    </script>

@endsection







