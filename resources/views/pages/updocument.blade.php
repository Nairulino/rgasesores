@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Subir Documento</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{route('home')}}">Panel de Control</a></li>
                <li class="active">Subir Documento</li>
            </ol>
        </div>
    </div>
    @include('partials.alerts')
  <!-- /.row -->
  <!-- .row -->
    <div class="row">
        <div class="col-md-12 col-xs-8">
            <div class="white-box">
              <h3>Selecciona el documento</h3>
              <br>
              <form action="{{route('upload.store')}}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                  <input type="file" name="documents" id="documents" class="form-control-file">
                </div>
                <div class="form-group">
                  <label>Descripción</label>
                  <br>
                  <textarea id="desc" name="desc" rows="2" class="form-control" style="width: 35rem"></textarea>
                </div>

                <div class="form-group">
                  <input type="submit" value="Subir Documento" class="btn btn-success">
                </div>
              </form>
            </div>
        </div>
    </div>
  <!-- /.row -->
</div>

@endsection
