@extends('layouts.app')
@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    @endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Principal</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
                <table class="table table-striped table-bordered">
                    <tr>
                        <td><a href="{{route('paciente.index')}}"><strong>Mis pacientes</strong></a></td>
                    </tr>
                    <tr>
                        <td><a href={{url('/medico/create')}}><strong>Mis evaluaciones</strong></a></td>
                    </tr>
                    <tr>
                        <td><a href={{url('/medico/create')}}><strong>Mis evaluaciones</strong></a></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
