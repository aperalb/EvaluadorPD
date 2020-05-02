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
        <div class="row">
            <div class="col-md-10 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"></div>

                    <div class="panel-body">

                        <h4>Tratamientos Vigentes</h4>
                        <hr>
                        <table class="table table-striped table-bordered" >
                            <tr>
                                <th>Medicamento</th>
                                <th>Dosis</th>
                                <th>Frecuencia Diaria</th>
                                <th>Fecha de Inicio del Tratamiento</th>
                                <th>Fecha de Fin del Tratamiento</th>
                                @if(Auth::User()->showRol()=='MEDICO')
                                    <th align ="center" colspan ="2">Acciones</th>
                                @endif
                            </tr>
                            @foreach($tratamientos as $tratamiento)

                                @if(date('Y-m-d') <= $tratamiento->fechafin || $tratamiento->fechafin == '')



                                    <tr>
                                        <td onmouseover="document.getElementById('vigentes.{{$tratamiento->id}}').style.display = '';" onmouseout="document.getElementById('vigentes.{{$tratamiento->id}}').style.display = 'none';">{{ $tratamiento->medicamento->nombre }}</td>
                                        <td onmouseover="document.getElementById('vigentes.{{$tratamiento->id}}').style.display = '';" onmouseout="document.getElementById('vigentes.{{$tratamiento->id}}').style.display = 'none';">{{ $tratamiento->dosis }}</td>
                                        <td onmouseover="document.getElementById('vigentes.{{$tratamiento->id}}').style.display = '';" onmouseout="document.getElementById('vigentes.{{$tratamiento->id}}').style.display = 'none';">{{ $tratamiento->frecuencia }}</td>
                                        <td onmouseover="document.getElementById('vigentes.{{$tratamiento->id}}').style.display = '';" onmouseout="document.getElementById('vigentes.{{$tratamiento->id}}').style.display = 'none';">{{ $tratamiento->fechainicio}}</td>
                                        <td onmouseover="document.getElementById('vigentes.{{$tratamiento->id}}').style.display = '';" onmouseout="document.getElementById('vigentes.{{$tratamiento->id}}').style.display = 'none';">{{ $tratamiento->fechafin}}</td>
                                        @if(Auth::User()->showRol()=='MEDICO')
                                            <td>
                                                {!! Form::open(['route' => ['tratamiento.edit',$tratamiento->id], 'method' => 'get']) !!}
                                                {!! Form::submit('Editar', ['class'=> 'btn btn-info'])!!}
                                                {!! Form::close() !!}                                    </td>
                                            <td>
                                                {!! Form::open(['route' => ['tratamiento.destroy',$tratamiento->id], 'method' => 'delete']) !!}
                                                {!! Form::submit('Eliminar', ['class'=> 'btn btn-danger','onClick'=>'return confirm("¿Seguro que deseas eliminar este tratamiento?");'])!!}
                                                {!! Form::close() !!}
                                            </td>
                                        @endif
                                    </tr>

                                    <tr id="vigentes.{{$tratamiento->id}}" style="display: none;">
                                        <td colspan="7">
                                            <a >
                                                <b>
                                                    Detalles
                                                    <pre>
                                                    <textarea readonly cols="60%" rows="4" class="form-control" style="background-color: whitesmoke">{{$tratamiento->detalles}}
                                                    </textarea>
                                                </pre>
                                                </b>
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </table>
                        <h4>Tratamientos Finalizados</h4>
                        <hr>
                        <table class="table table-striped table-bordered" >
                            <tr>
                                <th>Medicamento</th>
                                <th>Dosis</th>
                                <th>Frecuencia Diaria</th>
                                <th>Fecha de Inicio del Tratamiento</th>
                                <th>Fecha de Fin del Tratamiento</th>
                                @if(Auth::User()->showRol()=='MEDICO')
                                    <th align ="center" colspan ="2">Acciones</th>
                                @endif
                            </tr>

                            @foreach($tratamientos as $tratamiento)

                                @if(date('Y-m-d') > $tratamiento->fechafin && $tratamiento->fechafin != '')


                                    <tr>

                                        <td onmouseover="document.getElementById('finalizados.{{$tratamiento->id}}').style.display = '';" onmouseout="document.getElementById('finalizados.{{$tratamiento->id}}').style.display = 'none';">{{ $tratamiento->medicamento->nombre }}</td>
                                        <td onmouseover="document.getElementById('finalizados.{{$tratamiento->id}}').style.display = '';" onmouseout="document.getElementById('finalizados.{{$tratamiento->id}}').style.display = 'none';">{{ $tratamiento->dosis }}</td>
                                        <td onmouseover="document.getElementById('finalizados.{{$tratamiento->id}}').style.display = '';" onmouseout="document.getElementById('finalizados.{{$tratamiento->id}}').style.display = 'none';">{{ $tratamiento->frecuencia }}</td>
                                        <td onmouseover="document.getElementById('finalizados.{{$tratamiento->id}}').style.display = '';" onmouseout="document.getElementById('finalizados.{{$tratamiento->id}}').style.display = 'none';">{{ $tratamiento->fechainicio}}</td>
                                        <td onmouseover="document.getElementById('finalizados.{{$tratamiento->id}}').style.display = '';" onmouseout="document.getElementById('finalizados.{{$tratamiento->id}}').style.display = 'none';">{{ $tratamiento->fechafin}}</td>

                                        @if(Auth::User()->showRol()=='MEDICO')
                                            <td>
                                                {!! Form::open(['route' => ['tratamiento.edit',$tratamiento->id], 'method' => 'get']) !!}
                                                {!! Form::submit('Editar', ['class'=> 'btn btn-info'])!!}
                                                {!! Form::close() !!}                                    </td>
                                            <td>
                                                {!! Form::open(['route' => ['tratamiento.destroy',$tratamiento->id], 'method' => 'delete']) !!}
                                                {!! Form::submit('Eliminar', ['class'=> 'btn btn-danger','onClick'=>'return confirm("¿Seguro que deseas eliminar este tratamiento?");'])!!}
                                                {!! Form::close() !!}
                                            </td>
                                        @endif
                                    </tr>



                                    <tr id="finalizados.{{$tratamiento->id}}" style="display: none;">
                                        <td colspan="7">
                                            <a >
                                                <b>
                                                    Detalles
                                                    <pre>
                                                    <textarea readonly cols="60%" rows="4" class="form-control" style="background-color: whitesmoke">{{$tratamiento->detalles}}
                                                    </textarea>
                                                </pre>
                                                </b>
                                            </a>
                                        </td>
                                    </tr>

                                @endif
                            @endforeach
                        </table>


                        @if(Auth::User()->showRol()=='MEDICO')
                            <td>
                                <a href={{url('/tratamiento/create/?pacienteID='.$paciente->id)}} class="btn btn-info">Añadir Tratamiento</a>
                            </td>
                        @endif
                        <td>
                            <a href={{ url('/paciente/'.$paciente->id) }} class="btn btn-info">Volver</a>
                        </td>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection