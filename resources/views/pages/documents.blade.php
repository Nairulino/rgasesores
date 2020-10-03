@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Documentos</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{route('home')}}">Panel de Control</a></li>
                <li class="active">Documentos</li>
            </ol>
        </div>
    </div>
  <!-- /.row -->
  <!-- .row -->
    <div class="row">
        <div class="col-md-12 col-xs-8">
            <div class="white-box">
              {!! Form::open(['method'=>'post', 'action'=>'PostsController@store', 'files'=>true, 'class'=>'form-horizontal form-material']) !!}
              <div class="form-group">
                {!! Form::file('file', ['class'=>'form-control-file']) !!}
              </div>
                <div class="form-group">
                  {!! Form::label('title', 'Selecciona el documento', ['class'=>'col-md-12']) !!}
                  <div class="col-md-12">
                    {!! Form::text('title', null, ['class'=>'form-control-text']) !!}
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-12">
                    {!! Form::submit('Subir Documento', ['class'=>'btn btn-success']) !!}
                  </div>
                </div>
              {!! Form::close() !!}  
            </div>
        </div>
    </div>
  <!-- /.row -->
</div>

@endsection
