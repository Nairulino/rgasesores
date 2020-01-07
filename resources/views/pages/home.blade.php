@extends('layouts.app')

@section('content')
<div class="container-fluid">
<div class="row">
    <div class="col-2">
        <div class="card" id="panel-izq">
            <div class="card-header">Administrador</div>
            <div class="card-body-rg">
                <div class="container">
                    <div class="text-center">
                        <img id="avatar" src="/img/admin.jpg" height="105" width="105">
                        <p id="usuario">{{Auth::user()->name}}</p>
                    </div>
                    @if (Auth::user() != null)
                        @if(Auth::user()->id == 1)
                    <nav class="nav flex-column">
                        <a href="#" class="nav-link active"> Resumen </a>
                        <div class="dropdown">
                            <a href="#" class="nav-link" id="dropdownMenuButton" data-toggle="dropdown"> Clientes </a>
                            <div class="dropdown-menu">
                                <a href="{{route('personasfisicas')}}" class="nav-link"> Personas físicas </a>
                                <a href="#" class="nav-link"> Empresas </a> 
                                <a href="#" class="nav-link"> Sociedades </a>
                            </div>        
                        </div>
                        <a href="#" class="nav-link"> Documentos </a>
                        <a href="#" class="nav-link"> Notificar </a>
                        <a href="{{ route('register') }}" class="nav-link"> Añadir nuevo cliente </a>
                        <a href="#" class="nav-link"> Añadir nueva empresa </a>
                        <a href="#" class="nav-link"> Añadir nueva sociedad </a>
                    </nav>
                        @else
                    <nav class="nav flex-column">
                        <a href="#" class="nav-link active"> Resumen </a>
                        <a href=# class="nav-link"> Mis mensajes </a>
                        <a href="#" class="nav-link"> Trámites </a>
                        <a href="#" class="nav-link"> Crear consulta </a>
                    </nav>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
        <div class="col-10">
            <div class="card text-center" id="panel">
                    <div class="card-header text-left"> Panel de Administración</div>
                    <div class="fixed-center">
                        <div class="card-body-rg">
                            @yield('content-1')
                        </div>
                    </div>   
            </div>
        </div>
    </div>
</div>
@endsection
