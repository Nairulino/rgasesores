@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Mi Perfil</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{route('home')}}">Panel de Control</a></li>
                <li class="active">Modificar Perfil</li>
            </ol>
        </div>
    </div>
    @include('partials.alerts')
    <!-- /.row -->
    <!-- .row -->
    <div class="row">
        <div class="col-md-4 col-xs-12">
            <div class="white-box">
                <div class="user-bg">
                    <div class="overlay-box">
                        <div class="user-content">
                            <a href="javascript:void(0)"><img src="{{Storage::url($user->img)}}"
                                    class="thumb-lg img-circle" alt="img"></a>
                            <h4 class="text-white">{{$user->name}}</h4>
                            <h5 class="text-white">{{$user->email}}</h5>
                            <h5 class="text-white">{{$user->phone}}</h5>
                            <h5 class="text-white">{{$user->description}}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="white-box">
                    <h3>Cambiar la imagen de perfil</h3>
                    <br>
                    <form action="{{route('upload.update', $user->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            <input type="file" name="profile-picture" id="profile-picture" class="form-control-file">
                        </div>

                        <div class="form-group">
                            <input type="submit" value="Cambiar" class="btn btn-success">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-xs-12">
            <div class="white-box">
                <form class="form-horizontal form-material" action="{{route('users.update', $user->id) }}"
                    method="post">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="form-group">
                        <label class="col-md-12">Nombre completo</label>
                        <div class="col-md-12">
                            <input id="name" name="name" type="text" value="{{$user->name}}"
                                class="form-control form-control-line">
                        </div>
                        <div class="col-md-12" style="color:red">{{$errors->first('name')}}</div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-md-12">Email</label>
                        <div class="col-md-12">
                            <input id="email" name="email" type="email" value="{{$user->email}}"
                                class="form-control form-control-line" name="example-email" id="example-email">
                        </div>
                        <div class="col-md-12" style="color:red">{{$errors->first('email')}}</div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Nº Teléfono</label>
                        <div class="col-md-12">
                            <input id="phone" name="phone" type="text" value="{{$user->phone}}"
                                class="form-control form-control-line">
                        </div>
                        <div class="col-md-12" style="color:red">{{$errors->first('phone')}}</div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Descripción</label>
                        <div class="col-md-12">
                            <textarea id="description" name="description" rows="5"
                                class="form-control form-control-line">{{$user->description}}</textarea>
                        </div>
                        <div class="col-md-12" style="color:red">{{$errors->first('description')}}</div>
                    </div>
                    <div class="form-group">
                        <a href="{{route('users.update', $user->id)}}">
                            <div class="col-sm-12">
                                <button class="btn btn-success">Modificar Perfil</button>
                            </div>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>

@endsection