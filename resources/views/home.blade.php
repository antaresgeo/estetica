@extends('layouts.new.card')

@section('title', 'Calendario')

@section('header')
<nav id="navbar-example2" class="navbar navbar-light bg-light">

    <a class="navbar-brand" href="">
        <i class="fa fa-calendar" aria-hidden="true"></i>
        <span>Calendario</span>
    </a>
    <ul class="nav nav-pills">
        <li class="nav-item" style="margin-right: 7px">
            {!! Form::select(null, $sucursales, null, ['class' => 'form-control', 'id' => 'sucursal-filter']) !!}
        </li>
        <li class="nav-item" style="margin-right: 7px;">
            {!! Form::select(null, ['todas' => 'Todas', 'pendiente' => 'Pendientes', 'realizada' => 'Realizadas', 'cancelada' => 'Canceladas'] , null, ['class' => 'form-control', 'id' => 'estado-filter']) !!}
        </li>
        <li class="nav-item">
            <button id="acc"  type="button" class="btn btn-primary" style="margin-right: 7px">Crear Cliente</button>
        </li>
        <li class="nav-item">
            <button id="aat" type="button" class="btn btn-primary" style="margin-right: 7px;">Asignar Tratamiento</button>
        </li>
        <li class="nav-item">
            <button id="acr" type="button" class="btn btn-primary" style="margin-right: 7px;">Crear Reserva</button>
        </li>
        <li class="nav-item">
            <button id="aab" type="button" class="btn btn-primary">Asentar Pago</button>
        </li>
    </ul>
</nav>
@endsection

@section('body')
    @if (count($sucursales) > 0)
        <div id="calendar"></div>
    @endif
@endsection

@section('footer')
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
            </div>
            <br>
            <div class="panel-body">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('extra')
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
            {!! Form::text('identificacion', null,['class' => 'form-control', 'required' , 'placeholder' => '111xxx']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('email', 'Correo electrinico') !!}
                {!! Form::email('email', null, ['class' => 'form-control', 'required', 'placeholder' => 'ejemplo@gmail.com']) !!}
            </div>
            {{-- <div class="form-group">
                {!! Form::label('localidad', 'Localidad') !!}
                {!! Form::text('localidad', null,['class' => 'form-control', 'required' , 'placeholder' => 'localidad']) !!}
            </div> --}}
            <div class="form-group">
                {!! Form::label('facha_nacimiento', 'Fecha de nacimiento') !!}
                <div class="input-group date">
                    <span class="input-group-addon">
                        <span class="fa fa-calendar"></span>
                    </span>
                    {!! Form::text('facha_nacimiento', null,['class' => 'form-control', 'required', 'disabled', 'id' => 'datetimepicker1']) !!}
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
@endpush

@push('extra')
<div id="mat" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog table" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Asignar tratamiento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="table-responsive">
              <table class="table table-bordered" width="100%" cellspacing="0" id="datatable-clientes">
                  <thead class="thead-light">
                      <tr>
                          <th>Nombre</th>
                          <th>Telefono</th>
                          <th>DNI</th>
                          <th></th>
                          <th>Acción</th>
                      </tr>
                  </thead>
                  <tbody>
                  </tbody>
              </table>
          </div>
      </div>
      <div class="modal-footer">
          <a class="btn btn-primary" style="color: white" onclick="attor();">Crear Reserva</a>
          <button class="btn btn-primary" data-dismiss="modal" aria-label="Close">Salir</button>
      </div>
    </div>
  </div>
</div>
@endpush

@push('extra')
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
              <div class="form-group">
                  {!! Form::label('start', 'Hora de inico') !!}
                  <div class="input-group">
                      <span class="input-group-addon">
                          <span class="fa fa-calendar"></span>
                      </span>
                      {!! Form::text('start', null,['class' => 'form-control', 'required', 'disabled' , 'id' => 'datetimepicker2']) !!}
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
@endpush

@push('extra')
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
              {!! Form::label('cliente2', 'Cliente') !!}
              <br>
              {{-- {!! Form::select(null, [], null, ['class' => 'form-control', 'id' => 'autocomplete2']) !!} --}}
              {!! Form::text('cliente2', null,['class' => 'form-control', 'placeholder' => 'Buscar cliente', 'id' => 'autocomplete2']) !!}
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
@endpush


@push('extra')
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
@endpush

@push('css')
<link rel="stylesheet" href="{{ asset('fullcalendar/fullcalendar.min.css') }}">
<style media="screen">
    .modal-dialog.table{ max-width: 70%; }
    .autocomplete-suggestions { border: 1px solid #999; background: #FFF; overflow: auto; }
    .autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
    .autocomplete-selected { background: #F0F0F0; }
    .autocomplete-suggestions strong { font-weight: normal; color: #3399FF; }
    .autocomplete-group { padding: 2px 5px; }
    .autocomplete-group strong { display: block; border-bottom: 1px solid #000; }
    .fc-time-grid-event .fc-time, .fc-time-grid-event .fc-title{color: white; font-weight: 600;}
    /* .select2-container { width: 190px !important } */
</style>
@endpush
@push('scripts')
<script src="{{ asset('fullcalendar/fullcalendar.min.js') }}"></script>
<script src="{{ asset('fullcalendar/locale-all.js') }}"></script>
<script src="{{ asset('fullcalendar/calendario.js') }}"></script>
@endpush

@push('scripts')
<script>
$(function() {
    $('#selectT').select2({ dropdownParent: $("#mcr"), width: '100%'});
    $('#sucursal_id').select2({ dropdownParent: $("#mcr"), width: '100%'});
    $('#user_id').select2({ dropdownParent: $("#mcr"), width: '100%'});
    $('#selectCliente').select2({
        dropdownParent: $("#mcr"),
        width: '100%',
        ajax: {
            url: '{{ route('cliente.buscar')}}',
            dataType: 'json',
            data: function (term, page) {
                var query = {
                    sh: term.term
                }
                return query;
            },
            processResults: function (data, params) {
                params.page = params.page || 1;
                return {
                    results: $.map(data, function (dataItem) {
                        return { id: dataItem.id, text: dataItem.nombre, orginal: dataItem }
                    }),
                    pagination: {
                        more: false
                    }
                };
            }
        }
    });
    $('#selectCliente').on("select2:selecting", function(e) {
        var op = e.params.args.data.orginal;
        $.ajax({
            url: '{{ route('cliente.saldo', ['id' => ':id']) }}'.replace(':id', op.id),
            type: 'GET',
            success: function(response, status, jqXHR) {
                $('#info').html(`
                    <p>Total aquirido: ${response.precio}</p>
                    <p>Total Abonado: ${response.abonado}</p>
                    <p>Saldo Total: ${response.saldo}</p>`);
                $('#mcr').on('hidden.bs.modal', function (e) {
                    $('#fcr')[0].reset();
                    $('#info').empty();
                });
            },
            error: function(response, status, errorThrown) {
                console.log(response);
            }
        });
        $.ajax({
            url: '{{ route('cliente.tratamientos', ['id' => ':id']) }}'.replace(':id', op.id ),
            type: 'GET',
            success: function(response, status, jqXHR) {
                var s = $('<select id="selectT" class="form-control"/>');
                s.append($('<option selected="selected" value/>').html('----'));
                for (var i in response) {
                    s.append($('<option value="'+response[i].pivot.id+'"/>').html(response[i].nombre + ' ' + response[i].updated_at.split(' ')[0]));
                }
                $('#selectT').remove();
                $('#select-tratamientos').append(s);
                $('#selectT').select2({ dropdownParent: $("#mcr"), width: '100%'});
                $('#selectT').change(function() {
                    $('#extra').html('<input type="hidden" name="cliente_tratamiento_id" value="'+$(this).val()+'"/>');
                })
            },
            error: function(response, status, errorThrown) {
                console.log(response);
            }
        });
    });

    $('#autocomplete2').autocomplete({
        serviceUrl: '{{ route('cliente.buscar')}}',
        paramName: 'sh',
        transformResult: function(response) {
           return {
               suggestions: $.map(JSON.parse(response), function(dataItem) {
                   return { value: dataItem.nombre, data: dataItem };
               })
           };
       },
        onSelect: function (suggestion) {
            $.ajax({
                url: '{{ route('cliente.saldo', ['id' => ':id']) }}'.replace(':id', suggestion.data.id),
                type: 'GET',
                success: function(response, status, jqXHR) {
                    $('#info2').html(`
                        <span><b>Total a Pagar:</b> ${response.precio}</span><br>
                        <span><b>Total Abonado:</b> ${response.abonado}</span><br>
                        <span><b>Total Adeudado:</b> ${response.saldo}</span><br><br>`);
                    $('#mab').on('hidden.bs.modal', function (e) {
                        $('#fab')[0].reset();
                        $('#info2').empty();
                    });
                },
                error: function(response, status, errorThrown) {
                    console.log(response);
                }
            });
            $.ajax({
                url: '{{ route('cliente.tratamientos', ['id' => ':id']) }}'.replace(':id', suggestion.data.id ),
                type: 'GET',
                success: function(response, status, jqXHR) {
                    var s = $('<select id="selectT2" class="form-control"/>');
                    s.append($('<option selected="selected" value/>').html('----'));
                    for (var i in response) {
                        s.append($('<option value="'+response[i].pivot.id+'"/>').html(response[i].nombre + ' ' + response[i].updated_at.split(' ')[0]));
                    }
                    $('#selectT2').remove();
                    $('#select-tratamientos2').append(s);
                    $('#selectT2').change(function() {
                        $('#extra2').html('<input type="hidden" name="cliente_tratamiento_id" value="'+$(this).val()+'"/>');
                        $('#fab').attr('action', $('#fab').attr('action').replace(':id', $(this).val()));

                    })
                },
                error: function(response, status, errorThrown) {
                    console.log(response);
                }
            });
        }
    });


    clienteTable(
        '{{ asset('js/Spanish.json') }}',
        '{!! route('cliente.list') !!}',
        function ( data, type, row, meta ) {
            var select = '{!! Form::select(null, $tratamientos, null, ['class' => 'form-control select2filter', 'id' => 'tratamiento-filter-:id', 'placeholder' => '----']) !!}';
            return select.replace(':id', data);
        },
        function ( data, type, row, meta ) {
            var asignar = '{{ route('cliente.edit', ':id')}}'.replace(':id', data);
            return '<a href="#" class="btn btn-warning" style="margin-right: 7px;" onclick="asignar('+data+',\''+row.nombre+'\', \'{{ route('cliente.tratamiento.add')}}\'  )"><i class="fa fa-pencil" aria-hidden="true"></i> Asignar Tratamiento</a>';
        }
    );
});
</script>
@endpush
