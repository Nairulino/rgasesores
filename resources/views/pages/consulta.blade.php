@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Panel de Control</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="#">Panel de Control</a></li>
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
                    @foreach ($consultas as $consulta)
                    <div class="comment-body">
                        <div class="user-img"> <img src="../plugins/images/users/pawandeep.jpg" alt="user"
                                class="img-circle">
                        </div>
                        <div class="mail-contnet">
                            <h5>{{$consulta->user_name}}</h5><span class="time">{{$consulta->created_at}}</span>
                            <br /><span class="mail-desc">{{$consulta->content}}</span>
                            <a href="{{route('newConsulta')}}" class="btn btn btn-rounded btn-default btn-outline m-r-5"><i
                                    class="ti-check text-success m-r-5"></i>Contestar</a><a href="javacript:void(0)"
                                class="btn-rounded btn btn-default btn-outline"><i
                                    class="ti-close text-danger m-r-5"></i> Rechazar</a>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
    @endsection