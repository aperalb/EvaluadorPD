@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div >
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="floatLeft">

                            <h4>Datos personales Responsable</h4>
                            <table class="table table-striped table-bordered">


                                <tr>
                                    <th>Nombre</th>
                                    <td>{{ $responsable->getFullsurnameAttribute() }}</td>
                                </tr>
                                <tr>
                                    <th>Telefono</th>
                                    <td>{{ $responsable->numerotel }}</td>
                                </tr>
                                <tr>
                                    <th>Dirreccion</th>
                                    <td>{{ $responsable->direccion }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $responsable->direccion }}</td>
                                </tr>
                                <tr>
                                    <th>Parentesco</th>
                                    <td>{{ $responsable->getParentesco($paciente->id, $responsable->id) }}</td>
                                </tr>

                            </table>



                        </div>

                        <div class="floatRight">
                            <table class="table table-striped table-bordered">

                                <tr>
                                    <td rowspan="1">

                                        <img src="{{$responsable->fotografia}}"
                                             width="300" height="300"
                                             onerror="this.onerror=null; this.src='/images/Default.jpg'"
                                             alt="Fotografia" />

                                    </td>

                                </tr>


                                <tr>
                                    <td> <a href={{url('/responsable/editar/?responsableID='.$responsable->id."&&pacienteID=".$paciente->id)}} class="btn btn-info">Editar</a> </td>

                                </tr>
                                <tr>
                                    <td> <a href={{url('/responsable/delete/'.$responsable->id)}} class="btn btn-danger" onclick = "return confirm('¿Seguro que deseas eliminar este responsable?');" >Eliminar</a> </td>
                                </tr>


                            </table>
                        </div>




                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection