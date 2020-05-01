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


    <div class="container">




        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Categoría

                    <select name="categorias" id="categorias" style="margin-left: 10%; width: 25%">
                        <option value="">Todas</option>
                        @foreach($categorias as $categoria)
                            <option value="{{$categoria}}">{{$categoria}}</option>
                        @endforeach
                    </select>
                </th>
                <th>Nombre
                    <input id="tableSearch" type="text"
                           placeholder="Filtro nombre" style="margin-left: 10%; width: 25%">
                </th>

                <th>Descripción</th>
                <th colspan="2">Acciones</th>

            </tr>
            </thead>
            <tbody id="myTable">
            @foreach($medicamentos as $medicamento)
                <tr>
                    <td id="search">{{$medicamento->categoria}}</td>
                    <td id="search">{{$medicamento->nombre}}</td>
                    <td><a class="btn btn-info" href="javascript:ventanaSecundaria('/medicamento/show/{{$medicamento->id}}')">Ver Mas</a></td>
                    <td><a href={{url('/medicamento/edit/'.$medicamento->id)}} class="btn btn-success">Editar</a</td>
                    <td> <a href={{url('/medicamento/delete/'.$medicamento->id)}} class="btn btn-danger" onclick = "return confirm('¿Seguro que deseas eliminar este Medicamento?');" >Eliminar</a> </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <td>
            <a href={{url('/medicamento/create/')}} class="btn btn-info">Nuevo Medicamento</a>
        </td>
        <td>
            <a href={{url('/home')}} class="btn btn-info">Volver</a>
        </td>
    </div>

    <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

    <script>
        function Launch() {
            $("#dialog").dialog();

        }
    </script>
    <script type="text/javascript">
        $(document).ready(function(){

            $('#tableSearch').keyup(function(){
                // Search Text
                var search = $(this).val();
                var searchCategory=$('#categorias').val();
                // Hide all table tbody rows
                $('table tbody tr').hide();

                // Count total search result
                var len = $('table tbody tr:not(.notfound) td:nth-child(2):contains("'+search+'")').length;

                if(len > 0){
                    // Searching text in columns and show match row
                    $('table tbody tr:not(.notfound) td:nth-child(2):contains("'+search+'")').each(function(){
                        $(this).closest('tr').show();
                    });
                }else{
                    $('.notfound').show();
                }

            });


            $('#categorias').change(function(){
                // Search Text
                var search = $(this).val();

                // Hide all table tbody rows
                $('table tbody tr').hide();

                // Count total search result
                var len = $('table tbody tr:not(.notfound) td:nth-child(1):contains("'+search+'")').length;

                if(len > 0){
                    // Searching text in columns and show match row
                    $('table tbody tr:not(.notfound) td:nth-child(1):contains("'+search+'")').each(function(){
                        $(this).closest('tr').show();
                    });
                }else{
                    $('.notfound').show();
                }

            });

        });

        // Case-insensitive searching (Note - remove the below script for Case sensitive search )
        $.expr[":"].contains = $.expr.createPseudo(function(arg) {
            return function( elem ) {
                return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
            };
        });

        function ventanaSecundaria (URL){
            window.open(URL,"ventana1","width=800,height=800,left=500,scrollbars=YES")
        }

    </script>


@endsection

