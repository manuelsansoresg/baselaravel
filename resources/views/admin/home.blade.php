@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="card income text-center">
            <br><br>
            <h1>panel administrativo</h1>
            <h3>Bienvenido al panel administrativo {{Auth::user()->name}} </h3>

            <br><br>
        </div>
    </div>
@endsection