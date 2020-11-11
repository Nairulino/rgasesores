@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Mis documentos</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{route('home')}}">Panel de Control</a></li>
                <li class="active">Mis documentos</li>
            </ol>
        </div>
    </div>
    @include('partials.alerts')
  <!-- /.row -->
  <!-- .row -->
    <div class="row">
        <div class="col-md-12 col-xs-8">
            <div class="white-box">
                <h3>Mis documentos</h3>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Fecha creación</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                        $cont = 1
                        @endphp
                        @foreach ($documents as $document)
                            <tr>
                                <th scope="row">{{$cont++}} </th>
                                <td>{{$document->desc_doc}} </td>
                                <td>{{$document->created_at}}</td>
                                <td>
                                    <div class="btn-list" style="display: flex">
                                    <a href="{{route('documents.show', $document->id_doc)}}"> 
                                        <button type="button" class="btn waves-effect waves-light btn-secondary pull-left ">Ver</button>
                                    </a>
                                    <a href="{{route('documents.download', $document->id_doc)}}">
                                        <button type="button" class="btn waves-effect waves-light btn-info">Descargar</button>
                                    </a>
                                        <form action="{{-- {{route('users.destroy', $user->id)}} --}}" method="post">
                                            {{-- {{ method_field('DELETE') }}
                                            @csrf --}}
                                            <button type="submit" class="btn waves-effect waves-light btn-danger">Eliminar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$documents->links()}}
                </div>
            </div>
        </div>
    </div>
  <!-- /.row -->
</div>

@endsection
