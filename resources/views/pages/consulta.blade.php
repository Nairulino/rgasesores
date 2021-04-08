@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Consultas</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="#">Panel de Control</a></li>
                <li class="active">Consultas</li>
            </ol>
        </div>
    </div>
    @include('partials.alerts')
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="white-box">
                <h3 class="box-title">Consultas recientes</h3>
                @if(count($consultas) == 0)
                <h5>No hay consultas pendientes</h5>
                @else
                <div class="comment-center p-t-10">
                    <label hidden>{{$cont_tres = 1}}</label>
                    @foreach ($consultas as $consulta)
                    <label hidden>{{$cont_tres++}}</label>
                    @if($consulta->id_response == 0)
                    <div class="comment-body">
                        <div class="user-img"> <img src="{{Storage::url($consulta->img)}}" alt="user"
                                class="img-circle">
                        </div>
                        <div class="mail-contnet">
                            <h5>{{$consulta->name}}</h5><span class="time">{{$consulta->created_at}}</span>
                            <h4>{{$consulta->title}}</h4>
                            <span class="mail-desc">{{$consulta->content}}</span>
                            @if($consulta->files != '')
                                    <label hidden>{{$cont_dos = 1}}</label>
                                    <a class="btn btn-default" role="button" data-toggle="collapse"
                                        href="#archivosConsulta{{$cont_tres}}" aria-expanded="false" aria-controls="archivosConsulta{{$cont_tres}}">
                                        Ver archivos adjuntos
                                    </a>
                                    <div class="collapse" id="archivosConsulta{{$cont_tres}}">
                                        @foreach($consulta->files as $file)
                                        <a href="{{Storage::url($file)}}" target="_blank">
                                            <button class="btn btn-default">Adjunto {{$cont_dos++}}</button>
                                        </a>
                                        @endforeach
                                    </div>
                                    @endif
                            <label hidden>{{$cont = 1}}</label>
                            @foreach ($consultas_response as $consulta_response)
                            <label hidden>{{$cont++}}</label>
                            @if($consulta->id == $consulta_response->id_response)
                            <a class="btn btn-default" role="button" data-toggle="collapse" href="#respuesta{{$cont}}"
                                aria-expanded="false" aria-controls="respuesta{{$cont}}">
                                Ver respuesta
                            </a>
                            <div class="collapse" id="respuesta{{$cont}}">
                                <br>
                                <div class="user-img"> <img src="{{Storage::url($consulta_response->img)}}" alt="user"
                                        class="img-circle">
                                </div>
                                <div class="mail-contnet">
                                    <h5>{{$consulta_response->name}}</h5><span
                                        class="time">{{$consulta_response->created_at}}</span>
                                    <span class="mail-desc">{{$consulta_response->content}}</span>
                                    @if($consulta_response->files != '')
                                    <label hidden>{{$cont_uno = 1}}</label>
                                    <a class="btn btn-default" role="button" data-toggle="collapse"
                                        href="#archivosConsulta{{$cont}}" aria-expanded="false" aria-controls="archivosConsulta{{$cont}}">
                                        Ver archivos adjuntos
                                    </a>
                                    <div class="collapse" id="archivosConsulta{{$cont}}">
                                        @foreach($consulta_response->files as $file)
                                        <a href="{{Storage::url($file)}}" target="_blank">
                                            <button class="btn btn-default">Adjunto {{$cont_uno++}}</button>
                                        </a>
                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endif
                            @endforeach

                            @if(Auth::User()->admin == 1 && $consulta->answered != true)
                            <a href="{{route('consultas.answer', $consulta->id)}}"
                                class="btn btn-default btn-outline m-r-5">
                                <i class="ti-check text-success m-r-5"></i>Contestar</a>
                            <a href="javacript:void(0)" class="btn btn-danger btn-outline">
                                <i class="ti-close text-danger m-r-5"></i>Rechazar</a>
                            @endif
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
                @endif
                {{$consultas->links()}}
            </div>
        </div>
    </div>
    @endsection