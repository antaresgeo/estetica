<div id="mer" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Crear Reserva</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div id="cinfo"></div><br>
          {!! Form::open(['route' => ['reserva.update', ':id'], 'method' => 'PUT', 'id'=>'fer']) !!}
              <div class="form-group">
                  {!! Form::label('start', 'Hora de inico') !!}
                  <div class="input-group date" id="datetimepicker5" data-target-input="nearest">
                      <span class="input-group-addon" data-target="#datetimepicker5" data-toggle="datetimepicker">
                          <span class="fa fa-calendar"></span>
                      </span>
                      {!! Form::text('start', null,['class' => 'form-control  datetimepicker-input', 'required' , 'data-target' => '#datetimepicker5']) !!}
                  </div>
              </div>
              <div class="form-group">
                  {!! Form::label('end', 'Hora de finalización') !!}
                  <div class="input-group date" id="datetimepicker6" >
                      <span class="input-group-addon" data-target="#datetimepicker6">
                          <span class="fa fa-calendar"></span>
                      </span>
                      {!! Form::text(null, null,['id' => 'end' ,'class' => 'form-control', 'required', 'disabled' , 'data-target' => '#datetimepicker6']) !!}
                  </div>
              </div>
              <div class="form-group">
                  {!! Form::label('sucursal_id', 'Sucursal') !!}
                  {!! Form::select('sucursal_id', $sucursales, null, ['class' => 'form-control', 'placeholder' => '----' ]) !!}
              </div>
              <div class="form-group">
                  {!! Form::label('user_id', 'Profesional') !!}
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
          <a class="btn btn-primary" style="color: white" onclick="afer();">Guardar</a>
          <button class="btn btn-primary" data-dismiss="modal" aria-label="Close">Cancelar</button>
      </div>
    </div>
  </div>
</div>
