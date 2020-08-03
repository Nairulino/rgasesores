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
    <!-- /row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title">Personas físicas</h3>
                <div class="table-responsive">
                    <table class="table">
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
                    <td>{{$user->name}} </td>
                    <td>{{$user->email}} </td>
                    <td>
                        <div class="btn-list">
                        <a href="{{route('edit', $user->id)}}"> 
                                <button type="button" class="btn waves-effect waves-light btn-secondary pull-left ">Modificar</button>
                            </a>
                            <form action="{{route('users.destroy', $user->id)}}" method="post">
                                {{ method_field('DELETE') }}
                                @csrf
                                <button type="submit" class="btn waves-effect waves-light btn-danger">Eliminar</button>
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

@endsection
