<script src="{{ URL::asset('js/home.js') }}" defer></script>
<script src="{{ URL::asset('js/main.js')}}"></script>
<script src="{{ URL::asset('js/locales-all.js')}}"></script>
<script src="{{ URL::asset('js/userCalendar.js') }}" defer></script>
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

    <div class="row">
        <div class="col-md-12 col-lg-8 col-sm-12">
            <div class="white-box">
                <h3 class="box-title">Consultas recientes</h3>
                <div class="comment-center p-t-10">
                    <div class="comment-body">
                        <div class="user-img"> <img src="../plugins/images/users/pawandeep.jpg" alt="user"
                                class="img-circle">
                        </div>
                        <div class="mail-contnet">
                            <h5>Ricardo Ejemplo Consulta</h5><span class="time">10:20 AM 20 may 2020</span>
                            <br /><span class="mail-desc">Necesito información sobre lo que puede costar que me
                                tramiteis la renta. Gracias, un saludo.</span>
                            <a href="javacript:void(0)" class="btn btn btn-rounded btn-default btn-outline m-r-5"><i
                                    class="ti-check text-success m-r-5"></i>Contestar</a><a href="javacript:void(0)"
                                class="btn-rounded btn btn-default btn-outline"><i
                                    class="ti-close text-danger m-r-5"></i> Rechazar</a>
                        </div>
                    </div>
                    <div class="comment-body">
                        <div class="user-img"> <img src="../plugins/images/users/sonu.jpg" alt="user"
                                class="img-circle">
                        </div>
                        <div class="mail-contnet">
                            <h5>Sonu Ejemplo Consulta</h5><span class="time">10:20 AM 12 jun 2020</span>
                            <br /><span class="mail-desc">¿Qué documentos son los necesarios para poder solicitar el
                                ingreso mínimo vital?</span>
                            <a href="javacript:void(0)" class="btn btn btn-rounded btn-default btn-outline m-r-5"><i
                                    class="ti-check text-success m-r-5"></i>Contestar</a><a href="javacript:void(0)"
                                class="btn-rounded btn btn-default btn-outline"><i
                                    class="ti-close text-danger m-r-5"></i> Rechazar</a>
                        </div>
                    </div>
                    <div class="comment-body b-none">
                        <div class="user-img"> <img src="../plugins/images/users/arijit.jpg" alt="user"
                                class="img-circle">
                        </div>
                        <div class="mail-contnet">
                            <h5>Taruk Ejemplo Consulta</h5><span class="time">10:20 AM 20 jun 2020</span>
                            <br /><span class="mail-desc">¿Es necesario presentar el pasaporte para viajar fuera de
                                España?</span>
                            <a href="javacript:void(0)" class="btn btn btn-rounded btn-default btn-outline m-r-5"><i
                                    class="ti-check text-success m-r-5"></i>Contestar</a><a href="javacript:void(0)"
                                class="btn-rounded btn btn-default btn-outline"><i
                                    class="ti-close text-danger m-r-5"></i> Rechazar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="panel">
                <div class="sk-chat-widgets">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            AGENDA
                        </div>
                        <div id="calendar">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.container-fluid -->
    <!-- Modal Edit Event-->
    <div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="editEvent" autocomplete="off">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            id="closeModal"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modalTitle"></h4>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="title" class="col-sm-2 control-label">Título</label>
                            <div class="col-sm-10">
                                <input type="text" name="title" class="form-control" id="title" placeholder="Título"
                                    disabled>
                                <span class="invalid-feedback" style="display: none; color: red;" role="alert"
                                    id="titleError"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="client" class="col-sm-2 control-label">Cliente</label>
                            <div class="col-sm-10">
                                <input type="text" name="user" id="user" placeholder="Nombre del cliente" disabled
                                    class="form-control user">
                                <div id="users_list"></div>
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="descripcion" class="col-sm-2 control-label">Descripción</label>
                            <div class="col-sm-10">
                                <input type="text" name="description" class="form-control" id="description" disabled
                                    placeholder="Descripción">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="start" class="col-sm-2 control-label">Fecha inicio</label>
                            <div class="col-sm-10">
                                <input type="datetime-local" name="start" class="form-control" id="start" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="end" class="col-sm-2 control-label">Fecha final</label>
                            <div class="col-sm-10">
                                <input type="datetime-local" name="end" class="form-control" id="end" disabled>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection