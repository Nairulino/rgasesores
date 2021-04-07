@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Responder Consulta</h4>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
      <ol class="breadcrumb">
        <li><a href="{{route('home')}}">Panel de Control</a></li>
        <li class="">Consulta</li>
        <li class="active">Responder Consulta</li>
      </ol>
    </div>
  </div>
  @include('partials.alerts')
  <div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12">
      <form method='post' action="{{route('consultas.response')}}" class="form-horizontal form-material"
        autocomplete="off" enctype="multipart/form-data">
        @csrf
        <div class="white-box">
          <h3 class="box-title">Responder Consulta</h3>
          <div class="comment-center p-t-10">
            <div class="comment-body">
              <div class="user-img"> <img src="{{Storage::url($consulta[0]->img)}}" alt="user" class="img-circle">
              </div>
              <div class="mail-contnet">
                <h5>{{$consulta[0]->name}}</h5><span class="time">{{$consulta[0]->created_at}}</span>
                <h4>{{$consulta[0]->title}}</h4>
                <span class="mail-desc">{{$consulta[0]->content}}</span>
                @if($consulta[0]->files != '')
                <label hidden>{{$cont = 1}}</label>
                <a class="btn btn-default" role="button" data-toggle="collapse" href="#archivosConsulta"
                  aria-expanded="false" aria-controls="archivosConsulta">
                  Ver archivos adjuntos
                </a>
                <div class="collapse" id="archivosConsulta">
                  @foreach($consulta[0]->files as $file)
                  <a href="{{Storage::url($file)}}" target="_blank">
                    <button class="btn btn-default">Adjunto {{$cont++}}</button>
                  </a>
                  @endforeach
                </div>
                @endif
              </div>
            </div>
          </div>
          <div class="white-box">
            <div class="form-group">
              <input type="text" hidden value="{{$consulta[0]->id}}" id="id_response" name="id_response">
              <input type="text" hidden value="{{$consulta[0]->title}}" id="titulo" name="titulo">
              <label class="col-md-12">Respuesta</label>
              <div class="col-md-12">
                <textarea id="consulta" rows="5"
                  class="form-control form-control-line @error('consulta') is-invalid @enderror" name="consulta"
                  placeholder="Introduzca la respuesta..." value="{{old('consulta')}}" required></textarea>

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
                  <button type="submit" class="btn btn-success">{{ __('Responder') }}</button>
                </div>
              </a>
            </div>
      </form>
    </div>
  </div>
</div>
@endsection