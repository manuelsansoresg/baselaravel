@extends('layouts.admin')

@section('content')
    <!-- Breadcrumb-->
    <div class="breadcrumb-holder">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin/user">Usuarios</a></li>
                <li class="breadcrumb-item active">Nuevo Usuario </li>
            </ul>
        </div>
    </div>
    <section>
        <div class="row">
            <div class="container">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h4>Datos del Usuario</h4>
                        </div>
                        <div class="card-body">
                            {{ Form::open(['route' => 'user.store', 'method' => 'POST']) }}


                            <div class="form-group col-md-4">
                                <label>Nombre</label>
                                <input type="text" placeholder="Nombre de usuario" name="name" class="form-control" required>
                                @if($errors)
                                    <span class="text-danger"> {{$errors->first('name')}}</span>
                                @endif
                            </div>
                                <div class="form-group col-md-4">
                                    <label>Correo</label>
                                    <input type="email" placeholder="Correo de usuario" name="email" class="form-control" required>
                                    @if($errors)
                                        <span class="text-danger"> {{$errors->first('email')}}</span>
                                    @endif
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Tipo de usuario</label>
                                    <select name="role_user" id="role_user" class="form-control">
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control" required>
                                    @if($errors)
                                        <span class="text-danger"> {{$errors->first('password')}}</span>
                                    @endif
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="submit" class="btn btn-primary" value="Guardar">
                                </div>
                            {{ Form::close() }}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection