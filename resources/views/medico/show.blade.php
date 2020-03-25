@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Medicos</div>

                    <div class="panel-body">
                        <br><br>
                        <button>
                            <a href={{route('paciente.create')}}><big><strong>Nuevo Paciente</strong></big></a>
                        </button>
                        <button>
                            <a href="{{route('paciente.index')}}"><strong>Mis pacientes</strong></a>
                        </button>
                        <br><br>
                        <table class="table table-striped table-bordered" >
                            <tr>
                                <th colspan="6">Nombre Tabla</th>
                            </tr>

                            <tr>
                                <th>Nombre</th>
                            </tr>
                            @foreach ($medicos as $medico)
                                <tr>

                                    <td>{{ $medico->user->getFullsurnameAttribute() }}</td>

                                    </td>
                                </tr>
                            @endforeach

                        </table>


                    </div>
                </div>
            </div>
        </div>
@endsection