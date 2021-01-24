@extends('layouts.app')

@section('content')
<div id="calendar"></div>

<!-- Modal Add Event-->
<div class="modal fade" id="calendarModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form class="form-horizontal" id="createEvent" autocomplete="off">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
              aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="modalTitle"></h4>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label for="title" class="col-sm-2 control-label">Título</label>
            <div class="col-sm-10">
              <input type="text" name="title" class="form-control" id="title" placeholder="Título" required>
              <span class="invalid-feedback" style="display: none; color: red;" role="alert" id="titleError"></span>
            </div>
          </div>
          <div class="form-group">
            <label for="client" class="col-sm-2 control-label">Cliente</label>
            <div class="col-sm-10">
              <input type="text" name="user" id="user" placeholder="Nombre del cliente" class="form-control">
              <div id="user_list"></div>  
            </div>
              
          </div>
          <div class="form-group">
            <label for="descripcion" class="col-sm-2 control-label">Descripción</label>
            <div class="col-sm-10">
              <input type="text" name="description" class="form-control" id="description" placeholder="Descripción">
            </div>
          </div>
          <div class="form-group">
            <label for="start" class="col-sm-2 control-label">Fecha inicio</label>
            <div class="col-sm-10">
              <input type="datetime-local" name="start" class="form-control" id="start">
            </div>
          </div>
          <div class="form-group">
            <label for="end" class="col-sm-2 control-label">Fecha final</label>
            <div class="col-sm-10">
              <input type="datetime-local" name="end" class="form-control" id="end">
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="button" id="saveEvent" class="btn btn-primary">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Destroy Event-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form class="form-horizontal" id="deleteEvent">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
              aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Eliminar Evento</h4>
        </div>
        <div class="modal-body">
          <p>¿Estás seguro que quieres eliminar el evento?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
          <button type="button" id="confirmDelete" class="btn btn-primary">Si</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection