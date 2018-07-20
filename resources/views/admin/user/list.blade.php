@extends('layouts.admin')

@section('content')
    <!-- Breadcrumb-->
    <div class="breadcrumb-holder">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin/home">Home</a></li>
                <li class="breadcrumb-item active">Usuarios </li>
            </ul>
        </div>
    </div>
    <section>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    @role('root')
                    <a href="user/create" class="btn btn-primary float-right">Nuevo Usuario</a>
                    @endrole
                    <h4>Lista de usuarios</h4>

                </div>
                <div class="card-body">
                    @include('flash::message')
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name  }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <a href="{{route('user.edit', $user->id)}}" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                        <a href="{{route('admin.users.destroy', $user->id)}}" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>

                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('add_js')
    <script>
        $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
    </script>
@endsection
