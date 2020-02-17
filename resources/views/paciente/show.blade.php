@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Pacientes</div>

                    <div class="panel-body">
                        <table class="table table-striped table-bordered">
                            <tr>
                                <td>Datos personales del paciente</td>

                            </tr>
                            <td>Nombre</td>
                            <td colspan="2">{{ $paciente->nombre }}</td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection