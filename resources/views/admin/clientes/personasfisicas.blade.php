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
                <h3 class="box-title">Personas físicas</h3>
                <div class="box">
                    <form action="{{route('personasfisicas.search')}}" method="GET" class="form-inline" autocomplete="off">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-users fa-fw" aria-hidden="true"></i></div>
                                    <input name="name" type="text" class="form-control" placeholder="Nombre">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-at fa-fw" aria-hidden="true"></i></div>
                                    <input type="text" name="email" class="form-control" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-phone fa-fw" aria-hidden="true"></i></div>
                                    <input type="phone" name="phone" class="form-control" max="9" placeholder="Teléfono">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-barcode fa-fw" aria-hidden="true"></i></div>
                                    <input type="cif" name="cif" class="form-control" max="9" placeholder="DNI">
                                </div>
                            </div>
                            
                            <button type="submit" class="btn waves-effect waves-light"><i class="fa fa-search"></i></button>
                        
                    </form>
                </div>
                    
                <div class="table-responsive">
                    <table id="personasfisicas" class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Correo</th>
                                <th scope="col">Teléfono</th>
                                <th scoepe="col">DNI</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($personas as $user)
                            <tr>
                                <th scope="row">{{$user->id}} </th>
                                <td><a href="{{route('users.edit', $user->id)}}">{{$user->name}}</a></td>
                                <td>{{$user->email}} </td>
                                <td>{{$user->phone}}</td>
                                <td>{{$user->cif}}</td>
                                <td>
                                    <div class="btn-list" style="display: flex">
                                        <a href="{{route('users.edit', $user->id)}}">
                                            <button type="button"
                                                class="btn waves-effect waves-light btn-secondary pull-left ">Modificar</button>
                                        </a>
                                        <button type="button" class="btn waves-effect waves-light btn-danger" data-toggle="modal" data-target="#destroy{{$user->id}}">Eliminar</button>
                                    </div>
                                </td>
                            </tr>
                            <!-- Modal Destroy Users-->
                            <div class="modal fade" id="destroy{{$user->id}}" tabindex="-1" role="dialog" >
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Eliminar Persona física</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>¿Estás seguro que quieres eliminar al usuario?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{route('users.destroy', $user->id)}}" method="post">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                {{ method_field('DELETE') }}
                                                @csrf
                                                <button type="submit"
                                                    class="btn waves-effect waves-light btn-danger">Sí</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
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