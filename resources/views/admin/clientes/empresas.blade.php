@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Empresas</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{route('home')}}">Panel de Administración</a></li>
                <li class="active">Clientes</li>
                <li class="active">Empresas</li>
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
                        <form action="{{route('empresas.search')}}" method="GET" class="form-inline" autocomplete="off">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-briefcase fa-fw" aria-hidden="true"></i></div>
                                        <input name="name" type="text" class="form-control" placeholder="Nombre Empresa">
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
                    <table id="empresas" class="table">
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
                            @foreach ($empresas as $empresa)
                            <tr>
                                <th scope="row">{{$empresa->id}} </th>
                                <td><a href="#">{{$empresa->name}}</a></td>
                                <td>{{$empresa->user_name}}</td>
                                <td>{{$empresa->email}} </td>
                                <td>{{$empresa->phone}}</td>
                                <td>{{$empresa->cif}}</td>
                                <td>
                                    <div class="btn-list" style="display: flex">
                                        <a href="{{route('empresa.edit', $empresa->id)}}">
                                            <button type="button"
                                                class="btn waves-effect waves-light btn-secondary pull-left ">Modificar</button>
                                        </a>
                                        <form action="{{route('empresa.destroy', $empresa->id)}}" method="post">
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
                    {{$empresas->links()}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection