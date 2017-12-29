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
          </div>
          <div class="form-group" id="select-tratamientos2">
              {!! Form::label('selectT2', 'Tratamientos asignados') !!}
              <select id="selectT2" class="form-control">
                  <option selected="selected" value="">----</option>
              </select>
          </div>
          <div id="info2"></div>
          {!! Form::open(['route' => ['cliente.abonar', ':id'], 'method' => 'GET', 'id'=>'fab']) !!}
              {!! Form::token() !!}
              {!! Form::label('valor', 'Monto') !!}
              {!! Form::number('valor', null,['class' => 'form-control', 'placeholder' => 'Monto', 'min'=> 0]) !!}
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
