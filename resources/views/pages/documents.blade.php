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
    @include('partials.alerts')
    <!-- /.row -->
    <!-- .row -->
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="white-box">
                <h3>Documentos
                    <input id="search" type="text" placeholder="Buscar..." class="search"><i
                        class="fa fa-search"></i></a>
                    </form>
                </h3>
                <div class="table-responsive">
                    <table id="documents" class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Id Documento</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Usuario</th>
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
                                <th scope="row">{{$document->id}}</th>
                                <td>{{$document->desc_doc}} </td>
                                <td>{{$document->name}} </td>
                                <td>{{$document->created_at}}</td>
                                <td>
                                    <div class="btn-list" style="display: flex">
                                        <a href="{{route('documents.show', $document->id)}}">
                                            <button type="button"
                                                class="btn waves-effect waves-light btn-secondary pull-left ">Ver</button>
                                        </a>
                                        <a href="{{route('documents.download', $document->id)}}">
                                            <button type="button"
                                                class="btn waves-effect waves-light btn-info">Descargar</button>
                                        </a>
                                        <button type="button" class="btn waves-effect waves-light btn-danger" data-toggle="modal" data-target="#destroy">Eliminar</button>
                                    </div>
                                </td>
                            </tr>
                            <!-- Modal Destroy Document-->
                            <div class="modal fade" id="destroy" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Eliminar Documento</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>¿Estás seguro que quieres eliminar el documento?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{route('documents.destroy', $document->id)}}" method="post">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                {{ method_field('DELETE') }}
                                                @csrf
                                                <button type="submit"
                                                    class="btn waves-effect waves-light btn-danger">Sí</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
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