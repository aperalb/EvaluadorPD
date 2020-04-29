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
        <input class="form-control mb-4" id="tableSearch" type="text"
               placeholder="Type something to search list items">


        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>{{$medicamento->categoria}}</th>
                <th>{{$medicamento->nombre}}</th>
                <th>{{$medicamento->descripcion}}</th>
            </tr>
            </thead>
            <tbody id="myTable">
            @foreach($medicamentos as $medicamento){
            <tr>
                <td>John</td>
                <td>Doe</td>
                <td>john@example.com</td>
            </tr>
            <tr>
                <td>Mary</td>
                <td>Moe</td>
                <td>mary@mail.com</td>
            </tr>
            <tr>
                <td>July</td>
                <td>Dooley</td>
                <td>july@greatstuff.com</td>
            </tr>
            <tr>
                <td>Anja</td>
                <td>Ravendale</td>
                <td>a_r@test.com</td>
            </tr>
            @endif
            </tbody>
        </table>
    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            $("#tableSearch").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
@endsection

