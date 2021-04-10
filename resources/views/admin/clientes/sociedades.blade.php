@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Sociedades</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{route('home')}}">Panel de Administración</a></li>
                <li class="active">Clientes</li>
                <li class="active">Sociedades</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    @include('partials.alerts')
    <!-- /row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title">Empresas</h3>
                    <div class="box">
                        <form action="{{route('sociedades.search')}}" method="GET" class="form-inline" autocomplete="off">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-university fa-fw" aria-hidden="true"></i></div>
                                        <input name="name" type="text" class="form-control" placeholder="Nombre Sociedad">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-user fa-fw" aria-hidden="true"></i></div>
                                        <input name="user_name" type="text" class="form-control" placeholder="Nombre Cliente">
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
                                        <input type="cif" name="cif" class="form-control" max="9" placeholder="CIF">
                                    </div>
                                </div>
                                
                                <button type="submit" class="btn waves-effect waves-light"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                <div class="table-responsive">
                    <table id="sociedades" class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Cliente asociado</th>
                                <th scope="col">Correo</th>
                                <th scope="col">Teléfono</th>
                                <th scope="col">CIF</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sociedades as $sociedad)
                            <tr>
                                <th scope="row">{{$sociedad->id}} </th>
                                <td>{{$sociedad->name}} </td>
                                <td>{{$sociedad->user_name}}</td>
                                <td>{{$sociedad->email}} </td>
                                <td>{{$sociedad->phone}}</td>
                                <td>{{$sociedad->cif}}</td>
                                <td>
                                    <div class="btn-list" style="display: flex">
                                        <a href="{{route('users.edit', $sociedad->id)}}">
                                            <button type="button"
                                                class="btn waves-effect waves-light btn-secondary pull-left ">Modificar</button>
                                        </a>
                                        <form action="{{route('users.destroy', $sociedad->id)}}" method="post">
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
                    {{$sociedades->links()}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection