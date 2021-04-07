@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Crear Consulta</h4>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}">Panel de Control</a></li>
        <li class="active">Crear Consulta</li>
    </ol>
    </div>
  </div>
  @include('partials.alerts')
  <div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12">
      <div class="white-box">
        <form method='post' action="{{route('consultas.store')}}" class="form-horizontal form-material" autocomplete="off" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
              <label class="col-md-12">Título de la consulta</label>
              <div class="col-md-12">
                  <input id="titulo" type="text" placeholder="Introduzca el título de la consulta..." name="titulo"
                      class="form-control form-control-line @error('titulo') is-invalid @enderror" value="{{old('titulo')}}" required autofocus>

                  @error('titulo')
                  <span class="invalid-feedback" role="alert">
                      {{ $message }}
                  </span>
                  @enderror
              </div>
          </div>
          <div class="form-group">
              <label class="col-md-12">¿Qué desea consultar?</label>
              <div class="col-md-12">
                  <textarea id="consulta" rows="5" class="form-control form-control-line @error('consulta') is-invalid @enderror"
                      name="consulta" placeholder="Introduzca su consulta..." value="{{old('consulta')}}" required></textarea>

                  @error('consulta')
                  <span class="invalid-feedback" role="alert">
                      {{ $message }}
                  </span>
                  @enderror
              </div>
          </div>
          <div class="form-group">
            <label class="col-md-12">¿Desea adjuntar algún archivo?</label>
            <div class="col-md-12">
              <input type="file" class="form-control-file" id="archivos" name="archivos[]" multiple>
            </div>
        </div>
          <div class="form-group">
              <a href="#">
                  <div class="col-sm-12">
                      <button type="submit" class="btn btn-success">{{ __('Crear consulta') }}</button>
                  </div>
              </a>
          </div>
      </form>
      </div>
    </div>
  </div>
  @endsection