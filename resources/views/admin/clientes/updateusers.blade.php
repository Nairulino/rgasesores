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
  <!-- /.row -->
  <!-- .row -->
  <div class="row">
      <div class="col-md-4 col-xs-12">
          <div class="white-box">
              <div class="user-bg"> <img width="100%" alt="user" src="{{ URL::asset('../plugins/images/large/img1.jpg') }}">
                  <div class="overlay-box">
                      <div class="user-content">
                          <a href="javascript:void(0)"><img src="{{ URL::asset('../plugins/images/users/genu.jpg') }}"
                                  class="thumb-lg img-circle" alt="img"></a>
                          <h4 class="text-white">{{Auth::user()->name}}</h4>
                          <h5 class="text-white">{{Auth::user()->email}}</h5>
                      </div>
                  </div>
              </div>
              <div class="user-btm-box">
                  <div class="col-md-4 col-sm-4 text-center">
                      <p class="text-purple"><i class="ti-facebook"></i></p>
                      <h1>258</h1>
                  </div>
                  <div class="col-md-4 col-sm-4 text-center">
                      <p class="text-blue"><i class="ti-twitter"></i></p>
                      <h1>125</h1>
                  </div>
                  <div class="col-md-4 col-sm-4 text-center">
                      <p class="text-danger"><i class="ti-dribbble"></i></p>
                      <h1>556</h1>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-md-8 col-xs-12">
          <div class="white-box">
              <form class="form-horizontal form-material" action="{{route('users.update', $user->id) }}" method="post">
                @csrf
                {{ method_field('PUT') }}
                  <div class="form-group">
                      <label class="col-md-12">Nombre completo</label>
                      <div class="col-md-12">
                        <input id="name" name="name" type="text" value="{{$user->name}}"
                              class="form-control form-control-line"> </div>
                  </div>
                  <div class="form-group">
                      <label for="email" class="col-md-12">Email</label>
                      <div class="col-md-12">
                          <input id="email" name="email" type="email" value="{{$user->email}}"
                              class="form-control form-control-line" name="example-email"
                              id="example-email"> </div>
                  </div>
                  <div class="form-group">
                      <label class="col-md-12">Nº Teléfono</label>
                      <div class="col-md-12">
                          <input id="phone" name="phone" type="text" value="{{$user->phone}}"
                              class="form-control form-control-line"> </div>
                  </div>
                  <div class="form-group">
                      <label class="col-md-12">Descripción</label>
                      <div class="col-md-12">
                          <textarea id="description" name="description" rows="5" class="form-control form-control-line">{{$user->description}}</textarea>
                      </div>
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
