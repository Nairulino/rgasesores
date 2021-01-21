@extends('layouts.app')

@section('content')
<div id="calendar"></div>

<!-- Modal -->
<div class="modal fade" id="calendarModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
      <form class="form-horizontal" id="createEvent">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="modalTitle"></h4>
        </div>
        <div class="modal-body">
          
            <div class="form-group">
              <label for="title" class="col-sm-2 control-label">Título</label>
              <div class="col-sm-10">
                <input type="text" name="title" class="form-control" id="title" placeholder="Titulo" required>
              </div>
            </div>
            <div class="form-group">
              <label for="title" class="col-sm-2 control-label">Descripción</label>
              <div class="col-sm-10">
                <input type="text" name="descripcion" class="form-control" id="descripcion" placeholder="Descripcion">
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
@endsection