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
                    <div class="panel-heading">Síntomas</div>

                    <div class="panel-body">



                        @foreach(array_keys($categoriaYSintoma) as $catSintomas)

                            <h4><button onclick="myFunction('{{$catSintomas}}')" class="btn btn-link" style="font-size:20px">{{$catSintomas}}</button></h4>
                            <hr>

                            <div id="{{$catSintomas}}" style="display: none">
                                <table class="table table-striped table-bordered">
                                    @foreach($categoriaYSintoma[$catSintomas] as $sintoma)

                                        <tr>
                                            <th>{{ $sintoma->nombre }}</th>


                                            <td>
                                                {!! Form::open(['route' => ['sintoma.edit',$sintoma->id], 'method' => 'get']) !!}
                                                {!! Form::submit('Editar', ['class'=> 'btn btn-info'])!!}
                                                {!! Form::close() !!}
                                            </td>
                                            <td>
                                                {!! Form::open(['route' => ['sintoma.destroy',$sintoma->id], 'method' => 'delete']) !!}
                                                {!! Form::submit('Eliminar', ['class'=> 'btn btn-danger'])!!}
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"><a>  <pre><textarea readonly cols="140" rows="4">{{$sintoma->detalles}}</textarea></pre></a></td>
                                        </tr>
                                        <div>


                                        </div>
                                    @endforeach
                                </table>
                            </div>
                        @endforeach


                        <td>
                            <a href={{url('/sintoma/create/?pacienteID='.$paciente->id)}} class="btn btn-info">Añadir
                            Síntoma</a>
                        </td>
                        <td>
                            <a href={{ url()->previous() }} class="btn btn-info">Volver</a>
                        </td>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function myFunction(idDiv) {

            var x = document.getElementById(idDiv);
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
    </script>
@endsection

