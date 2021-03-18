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
        <h3 class="box-title">Crear consulta</h3>
        <div class="card">
          <div class="card-body">
            <form class="m-t-4">
              <div class="">
                <div class="m-b-3">
                  <input type="text" class="form-control" placeholder="Name">
                </div>
                <div class="m-b-3">
                  <input type="email" class="form-control" placeholder="Email">
                </div>
                <div class="email-repeater m-b-3">
                  <div data-repeater-list="repeater-group">
                    <div data-repeater-item class="row m-b-3">
                      <div class="col-md-10">
                        <div class="custom-file">
                          <input type="file" class="form-control-file" id="customFile">
                        </div>
                      </div>
                      <div class="col-md-2">
                        <button data-repeater-delete="" class="btn btn-danger waves-effect waves-light" type="button">
                          <i data-feather="x-circle" class="feather-sm fill-white"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                  <button type="button" data-repeater-create="" class="btn btn-info waves-effect waves-light">
                    <div class="d-flex align-items-center">
                      Add More File
                      <i data-feather="plus-circle" class="feather-sm ms-2 fill-white"></i>
                    </div>
                  </button>
                </div>
                <div class="mb-3">
                  <textarea class="form-control" rows="3" placeholder="Message"></textarea>
                </div>
                <div class="mb-3">
                  <button
                    class="btn rounded-pill px-4 btn-light-success text-success font-weight-medium waves-effect waves-light"
                    type="submit">
                    <i data-feather="send" class="feather-sm ms-2 fill-white"></i>
                    Submit
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection