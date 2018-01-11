<div id="mcc" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Crear Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          {!! Form::open(['route' => 'cliente.store', 'method' => 'POST', 'id'=>'fcc']) !!}
            <input type="hidden" name="noreload" value="true">
            <div class="form-group">
            {!! Form::label('nombre', 'Nombre') !!}
            {!! Form::text('nombre', null, ['class' => 'form-control', 'required', 'placeholder' => 'Nombre']) !!}
            </div>
            <div class="form-group">
            {!! Form::label('telefono', 'Numero Telefonico') !!}
            {!! Form::text('telefono', null, ['class' => 'form-control', 'required', 'placeholder' => '111xxx']) !!}
            </div>
            <div class="form-group">
            {!! Form::label('identificacion', 'DNI') !!}
            {!! Form::text('identificacion', null,['class' => 'form-control', 'placeholder' => '111xxx']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('email', 'Correo electrinico') !!}
                {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'ejemplo@gmail.com']) !!}
            </div>
            {{-- <div class="form-group">
                {!! Form::label('localidad', 'Localidad') !!}
                {!! Form::text('localidad', null,['class' => 'form-control', 'required' , 'placeholder' => 'localidad']) !!}
            </div> --}}
            <div class="form-group">
                {!! Form::label('datetimepicker1', 'Fecha de nacimiento') !!}
                <div class="input-group date">
                    <span class="input-group-addon">
                        <span class="fa fa-calendar"></span>
                    </span>
                    {!! Form::text('facha_nacimiento', null,['class' => 'form-control', 'readonly', 'size' =>'16', 'id' => 'datetimepicker1']) !!}
                </div>
            </div>
            {{-- <div class="form-group">
                {!! Form::label('ocupacion', 'Ocupación') !!}
                {!! Form::text('ocupacion', null,['class' => 'form-control', 'required' , 'placeholder' => 'ocupación']) !!}
            </div> --}}
        {!! Form::close() !!}
      </div>
      <div class="modal-footer">
          <a class="btn btn-primary" style="color: white" onclick="afcc(false);">Guardar y asignar Tratamiento</a>
          <a class="btn btn-primary" style="color: white" onclick="afcc(true);">Guardar y salir</a>
          <button class="btn btn-primary" data-dismiss="modal" aria-label="Close">Cancelar</button>
      </div>
    </div>
  </div>
</div>
