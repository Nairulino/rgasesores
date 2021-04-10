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
            <label class="col-md-12">Cliente asociado a la consulta</label>
            <div class="col-md-3">
              <div class="input-group">
                <input id="cliente" type="text" placeholder="Introduzca el cliente asociado..." name="cliente"
                      class="form-control @error('cliente') is-invalid @enderror" value="{{old('cliente')}}" required autofocus>
                <div data-toggle="modal" data-target="#search" class="input-group-addon"><i class="fa fa-search fa-fw" aria-hidden="true"></i></div>
              </div>
              @error('cliente')
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
  <!-- Modal Show Users-->
  <div class="modal fade" id="search" tabindex="-1" role="dialog" >
    <div class="modal-dialog" role="search">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Clientes registrados</h4>
            </div>
            <div class="modal-body">
                <form action="" method="get" class="form-inline">
                  <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-user fa-fw" aria-hidden="true"></i></div>
                        <input name="name" type="text" class="form-control" placeholder="Nombre Cliente">
                    </div>
                  </div>
                  <button type="submit" class="btn waves-effect waves-light"><i class="fa fa-search"></i></button>
                </form>
                <div class="card">
                  
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Nombre Cliente</th>
                        <th>Acción</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach( $clientes as $cliente)
                      <tr>
                        <td>{{$cliente->name}}</td>
                        <td><button class="btn btn-primary">Seleccionar</button></td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  {{$clientes->links()}}
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
@endsection