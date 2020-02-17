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
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>

                <div>
                    <td><a href={{route('medico.index')}}><big><strong>Medicos</strong></big></a></td>
                </div>
                <div>
                    <td><a href={{route('medico.create')}}><big><strong>Crear Medico</strong></big></a></td>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
