@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Personas físicas</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{route('home')}}">Panel de Administración</a></li>
                <li class="active">Clientes</li>
                <li class="active">Personas físicas</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    @include('partials.alerts')
    <!-- /row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                    <form action="{{route('personasfisicas.search')}}" method="GET">
                        @csrf
                        <h3 class="box-title">Personas físicas
                            <input id="search" name="search" type="text" placeholder="Buscar..." class="search">
                            <button type="submit" class="btn waves-effect waves-light"><i class="fa fa-search"></i></button>
                        </h3>
                    </form>
                <div class="table-responsive">
                    <table id="personasfisicas" class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Correo</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($personas as $user)
                            <tr>
                                <th scope="row">{{$user->id}} </th>
                                <td><a href="{{route('users.edit', $user->id)}}">{{$user->name}}</a></td>
                                <td>{{$user->email}} </td>
                                <td>
                                    <div class="btn-list" style="display: flex">
                                        <a href="{{route('users.edit', $user->id)}}">
                                            <button type="button"
                                                class="btn waves-effect waves-light btn-secondary pull-left ">Modificar</button>
                                        </a>
                                        <form action="{{route('users.destroy', $user->id)}}" method="post">
                                            {{ method_field('DELETE') }}
                                            @csrf
                                            <button type="submit"
                                                class="btn waves-effect waves-light btn-danger">Eliminar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$personas->links()}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection