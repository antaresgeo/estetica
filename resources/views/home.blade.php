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
    @include('modals.mcc')
@endpush

@push('extra')
    @include('modals.mat')
@endpush

@push('extra')
    @include('modals.mcr')
@endpush

@push('extra')
    @include('modals.mab')
@endpush


@push('extra')
    @include('modals.mer')
@endpush

@push('css')
<link rel="stylesheet" href="{{ asset('fullcalendar/fullcalendar.min.css') }}">
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
    $('#selectT').on("select2:selecting", function (e) {
        sucursaltratamiento($('#sucursal_id').val(), e.params.args.data.id);
    });
    $('#sucursal_id').select2({ dropdownParent: $("#mcr"), width: '100%'});
    $('#sucursal_id').on("select2:selecting", function (e) {
        sucursaltratamiento(e.params.args.data.id, $('#selectT').val(), );
    });
    $('#user_id').select2({ dropdownParent: $("#mcr"), width: '100%'});

    // var sucursal_id = ;
    // var tratamiento_id = $('#selectT').val();

    function sucursaltratamiento(sucursal_id, tratamiento_id) {
        if(sucursal_id && tratamiento_id){
            $.ajax({
                url: '{{ route('rotativo.valid', ['sucursal' => ':sucursal', 'tratamiento' => ':tratamiento']) }}'
                    .replace(':sucursal', sucursal_id)
                    .replace(':tratamiento', tratamiento_id),
                type: 'GET',
                success: function(response, status, jqXHR) {
                    console.log('o.o');
                    if(response.res){
                        console.log(response.data);
                        $('#datetimepicker2').datepicker('destroy');
                        $('#datetimepicker2').datepicker({
                            startDate: new Date(),
                            format:'yyyy-mm-dd',
                            language:  'es',
                            autoclose: true,
                            beforeShowDay: function (date) {
                                var year = date.getFullYear();
                                var mes = (date.getMonth() + 1);
                                var month = (mes<9? '0'+mes: mes);
                                var date = (date.getDate()<9? '0'+date.getDate(): date.getDate());
                                var allDates =  year + '-' + month + '-' + date;
                                console.log(allDates);
                                return (response.data.indexOf(allDates) != -1?true:false);
                            }
                        });
                        $('#datetimepicker3').datepicker('remove')
                        $('#datetimepicker3').datetimepicker({
                            startView: 1,
                            format:'hh:ii',
                            language:  'es',
                            autoclose: true
                        });
                        $('#startBlock').text('Las reservas de este tratamiento en esta sucursal tienen dias no disponibles, parareceran dectivados al tratar de selecionarlos');
                    }else{
                        $('#datetimepicker2').datepicker('destroy')
                        $('#datetimepicker2').datepicker({
                            startDate: new Date(),
                            format:'yyyy-mm-dd',
                            language:  'es',
                            autoclose: true,
                        });
                        $('#datetimepicker3').datepicker('remove')
                        $('#datetimepicker3').datetimepicker({
                            startView: 1,
                            format:'hh:ii',
                            language:  'es',
                            autoclose: true
                        });
                        $('#startBlock').text('');
                    }
                },
                error: function(response, status, errorThrown) {
                    console.log(response);
                }
            });
        }
    }
    $('#selectCliente').select2({
        placeholder: '----',
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

    $('#selectT2').select2({ dropdownParent: $("#mab"), width: '100%'});
    $('#selectCliente2').select2({
        placeholder: '----',
        dropdownParent: $("#mab"),
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
                    s.append($('<option value="'+response[i].pivot.id+'"/>').html(response[i].nombre + ' ' + response[i].pivot.updated_at.split(' ')[0]));
                }
                $('#selectT').remove();
                $('#select-tratamientos').append(s);
                $('#selectT').select2({ dropdownParent: $("#mcr"), width: '100%'});
                $('#selectT').on("select2:selecting", function (e) {
                    sucursaltratamiento($('#sucursal_id').val(), e.params.args.data.id);
                });
                $('#selectT').change(function() {
                    $('#extra').html('<input type="hidden" name="cliente_tratamiento_id" value="'+$(this).val()+'"/>');
                })
            },
            error: function(response, status, errorThrown) {
                console.log(response);
            }
        });
    });

    $('#selectCliente2').on("select2:selecting", function(e) {
            var op = e.params.args.data.orginal;
            $.ajax({
                url: '{{ route('cliente.saldo', ['id' => ':id']) }}'.replace(':id', op.id),
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
                url: '{{ route('cliente.tratamientos', ['id' => ':id']) }}'.replace(':id', op.id ),
                type: 'GET',
                success: function(response, status, jqXHR) {
                    var s = $('<select id="selectT2" class="form-control"/>');
                    s.append($('<option selected="selected" value/>').html('----'));
                    for (var i in response) {
                        s.append($('<option value="'+response[i].pivot.id+'"/>').html(response[i].nombre + ' ' + response[i].pivot.updated_at.split(' ')[0]));
                    }
                    $('#selectT2').remove();
                    $('#select-tratamientos2').append(s);
                    $('#selectT2').select2({ dropdownParent: $("#mab"), width: '100%'});
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
    );


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
