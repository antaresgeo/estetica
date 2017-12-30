<div id="mab" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Asentar Pago</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-group">
               {!! Form::label('selectCliente2', 'Cliente') !!}
               <select id="selectCliente2" class="form-control"></select>
               <small id="info2" class="form-text text-muted"></small>
          </div>
          <div class="form-group">
              {!! Form::label('selectT2', 'Tratamientos asignados') !!}
              <div id="select-tratamientos2">
                  <select id="selectT2" class="form-control">
                      <option selected="selected" value="">----</option>
                  </select>
              </div>
              <small id="info2t" class="form-text text-muted"></small>
          </div>
          {!! Form::open(['route' => ['cliente.abonar', ':id'], 'method' => 'GET', 'id'=>'fab']) !!}
              {!! Form::token() !!}
              <div class="form-group">
              {!! Form::label('valor', 'Monto') !!}
              {!! Form::number('valor', null,['class' => 'form-control', 'placeholder' => 'Monto', 'min'=> 0]) !!}
              </div>
              <div class="form-group">
                  {!! Form::label('is_anticipo', 'Anticipo') !!}
                  {!! Form::checkbox('is_anticipo', 'yes', null) !!}
              </div>
              <div id="extra2"></div>
          {!! Form::close() !!}
      </div>
      <div class="modal-footer">
          <a class="btn btn-primary" style="color: white" onclick="afab();">Guardar</a>
          <button class="btn btn-primary" data-dismiss="modal" aria-label="Close">Cancelar</button>
      </div>
    </div>
  </div>
</div>
