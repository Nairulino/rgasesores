@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Registrar Usuario</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{route('home')}}">Panel de Control</a></li>
                <li class="active">Registrar Usuario</li>
            </ol>
        </div>
    </div>
  <!-- /.row -->
  <!-- .row -->
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="white-box">
            <form method='post' action="{{route('register')}}" class="form-horizontal form-material">
                @csrf
                    <div class="form-group">
                        <label class="col-md-12">Nombre</label>
                        <div class="col-md-12">
                            <input id="name" type="text" placeholder="Nombre y apellidos" name="name" class="form-control form-control-line @error('name') is-invalid @enderror" required autocomplete="name" autofocus> 

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="example-email" class="col-md-12">Email</label>
                        <div class="col-md-12">
                            <input id="email" type="email" placeholder="Email" class="form-control form-control-line @error('email') is-invalid @enderror" name="email" required> 

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Contraseña</label>
                        <div class="col-md-12">
                            <input id="password" type="password" placeholder="Introduce la contraseña" name="password" class="form-control form-control-line  @error('password') is-invalid @enderror" required autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Confirmar contraseña</label>
                        <div class="col-md-12">
                            <input id="password-confirm"  type="password" placeholder="Confirma la contraseña" class="form-control form-control-line" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Nº Teléfono</label>
                        <div class="col-md-12">
                            <input id="phone" type="text" placeholder="111333666"
                                class="form-control form-control-line" name="phone" required> </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Descripción</label>
                        <div class="col-md-12">
                            <textarea id="description" rows="5" class="form-control form-control-line" name="description"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <a href="#">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-success">{{ __('Registrar usuario') }}</button>
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
