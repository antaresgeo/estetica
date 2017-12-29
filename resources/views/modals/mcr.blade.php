<div id="mcr" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Crear Reserva</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-group">
               {!! Form::label('selectCliente', 'Cliente') !!}
               <select id="selectCliente" class="form-control"></select>
          </div>
          <div class="form-group" id="select-tratamientos">
              {!! Form::label('selectT', 'Tratamiento/s') !!}
              <select id="selectT" class="form-control">
                  <option selected="selected" value="">----</option>
              </select>
          </div>
          <div id="info"></div>
          {!! Form::open(['route' => 'reserva.store', 'method' => 'POST', 'id'=>'fcr']) !!}
              <div class="form-group">
                  {!! Form::label('sucursal_id', 'Sucursal') !!}
                  {!! Form::select('sucursal_id', $sucursales, null, ['class' => 'form-control', 'placeholder' => '----' ]) !!}

              </div>
              <div class="row">
                  <div class="col-lg-8">
                      <div class="form-group">
                          {!! Form::label('datetimepicker2', 'Fecha') !!}
                          <div class="input-group">
                              <span class="input-group-addon">
                                  <span class="fa fa-calendar"></span>
                              </span>
                              {!! Form::text('start1', null,['class' => 'form-control', 'required', 'readonly', 'size' =>'16', 'id' => 'datetimepicker2']) !!}
                          </div>
                          <small id="startBlock" class="form-text text-muted"></small>
                      </div>
                  </div>
                  <div class="col-lg-4">
                      <div class="form-group">
                          {!! Form::label('datetimepicker3', 'Hora de inico') !!}
                          <div class="input-group">
                              <span class="input-group-addon">
                                  <span class="fa fa-clock-o"></span>
                              </span>
                              {!! Form::text('start2', null,['class' => 'form-control', 'required', 'readonly', 'size' =>'16', 'id' => 'datetimepicker3']) !!}
                          </div>
                          <small id="startBlock" class="form-text text-muted"></small>
                      </div>
                  </div>
              </div>
              <div class="form-group">
                  {!! Form::label('user_id', 'Vendedor') !!}
                  {!! Form::select('user_id', $profesionales, null, ['class' => 'form-control', 'placeholder' => '----' ]) !!}
              </div>
              <div class="form-group">
                  {!! Form::label('valor', 'Monto') !!}
                  {!! Form::number('valor', null,['class' => 'form-control', 'placeholder' => 'Monto', 'min'=> 0]) !!}
              </div>
              <div id="extra"></div>
          {!! Form::close() !!}
      </div>
      <div class="modal-footer">
          <a class="btn btn-primary" style="color: white" onclick="afcr2();">Guardar y Seguir Reservando</a>
          <a class="btn btn-primary" style="color: white" onclick="afcr();">Guardar y Salir</a>
          <button class="btn btn-primary" data-dismiss="modal" aria-label="Close">Salir</button>
      </div>
    </div>
  </div>
</div>
