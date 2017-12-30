<div id="mer" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Editar Reserva</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div id="cinfo"></div><br>
          {!! Form::open(['route' => ['reserva.update', ':id'], 'method' => 'PUT', 'id'=>'fer']) !!}
              <div class="row">
                  <div class="col-lg-8">
                      <div class="form-group">
                          {!! Form::label('datetimepicker5', 'Fecha') !!}
                          <div class="input-group">
                              <span class="input-group-addon">
                                  <span class="fa fa-calendar"></span>
                              </span>
                              {!! Form::text('start1', null,['class' => 'form-control', 'required', 'readonly', 'size' =>'16', 'id' => 'datetimepicker5']) !!}
                          </div>
                          <small id="startBlock" class="form-text text-muted"></small>
                      </div>
                  </div>
                  <div class="col-lg-4">
                      <div class="form-group">
                          {!! Form::label('datetimepicker7', 'Hora de inico') !!}
                          <div class="input-group">
                              <span class="input-group-addon">
                                  <span class="fa fa-clock-o"></span>
                              </span>
                              {!! Form::text('start2', null,['class' => 'form-control', 'required', 'readonly', 'size' =>'16', 'id' => 'datetimepicker7']) !!}
                          </div>
                          <small id="startBlock" class="form-text text-muted"></small>
                      </div>
                  </div>
              </div>
              <div class="form-group">
                  {!! Form::label('datetimepicker6', 'Fecha y  Hora de finalización') !!}
                  <div class="input-group">
                      <span class="input-group-addon">
                          <span class="fa fa-calendar"></span>
                      </span>
                      {!! Form::text(null, null,['class' => 'form-control', 'disabled', 'size' =>'16', 'id' => 'datetimepicker6']) !!}
                  </div>
              </div>
              <div class="form-group">
                  {!! Form::label('sucursal_id', 'Sucursal') !!}
                  {!! Form::select('sucursal_id', $sucursales, null, ['class' => 'form-control', 'placeholder' => '----' ]) !!}
              </div>
              <div class="form-group">
                  {!! Form::label('user_id', 'Vendedor') !!}
                  {!! Form::select('user_id', $profesionales, null, ['class' => 'form-control', 'placeholder' => '----' ]) !!}
              </div>
              <div class="form-group">
                  {!! Form::label('estado', 'Estado') !!}
                  {!! Form::select('estado', ['pendiente' => 'Pendiente', 'realizada' => 'Realizada', 'cancelada' => 'Cancelada'], null, ['class' => 'form-control', 'placeholder' => '----' ]) !!}
              </div>
              <div id="extra">
                  <input id="cliente_tratamiento_id" type="hidden" name="cliente_tratamiento_id" value/>
              </div>
          {!! Form::close() !!}
      </div>
      <div class="modal-footer">
          <a id="sr" class="btn btn-primary" style="color: white">Seguir Reservando</a>
          <a id="ap" class="btn btn-primary" style="color: white">Asentar pago</a>
          <a class="btn btn-primary" style="color: white" onclick="afer();">Guardar</a>
          <button class="btn btn-primary" data-dismiss="modal" aria-label="Close">Cancelar</button>
      </div>
    </div>
  </div>
</div>
