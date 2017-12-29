$(document).ready(function() {
    //cargando(cont);

    Date.prototype.getWeek = function() {
        var date = new Date(this.getTime());
        date.setHours(0, 0, 0, 0);
        // Thursday in current week decides the year.
        date.setDate(date.getDate() + 3 - (date.getDay() + 6) % 7);
        // January 4 is always in week 1.
        var week1 = new Date(date.getFullYear(), 0, 4);
        // Adjust to Thursday in week 1 and count number of weeks from date to week1.
        return 1 + Math.round(((date.getTime() - week1.getTime()) / 86400000 - 3 + (week1.getDay() + 6) % 7) / 7);
    };

    initdatepicker();

    calendario();
    // $('.form_datetime').datetimepicker({
    //     //language:  'fr',
    //     weekStart: 1,
    //     todayBtn:  1,
	// 	autoclose: 1,
	// 	todayHighlight: 1,
	// 	startView: 2,
	// 	forceParse: 0,
    //     showMeridian: 1
    // });
	// $('.form_date').datetimepicker({
    //     language:  'fr',
    //     weekStart: 1,
    //     todayBtn:  1,
	// 	autoclose: 1,
	// 	todayHighlight: 1,
	// 	startView: 2,
	// 	minView: 2,
	// 	forceParse: 0
    // });
	// $('.form_time').datetimepicker({
    //     language:  'fr',
    //     weekStart: 1,
    //     todayBtn:  1,
	// 	autoclose: 1,
	// 	todayHighlight: 1,
	// 	startView: 1,
	// 	minView: 0,
	// 	maxView: 1,
	// 	forceParse: 0
    // });

});

function initdatepicker() {
    $('#datetimepicker1').datepicker({
        format: 'yyyy-mm-dd',
        language:  'es',
        autoclose: true,
    });
    $('#datetimepicker2').datepicker({
        startDate: new Date(),
        format:'yyyy-mm-dd',
        language:  'es',
        autoclose: true,
        beforeShowDay: function (date){
            return false;
        }
    });
}

function cargando(query) {
    var loading = `<div class="full-height"><div class="preloader-wrapper big active">
        <div class="spinner-layer spinner-purple-only">
            <div class="circle-clipper left">
                <div class="circle">
                </div>
            </div>
            <div class="gap-patch">
                <div class="circle">
                </div>
            </div>
            <div class="circle-clipper right">
                <div class="circle"></div>
                </div>
            </div>
        </div>
    </div>`;
    query.prepend(loading);
}

function des(estado) {
    if (estado) {
        return "Desasignar"
    }
    return "Asignar"
}

function hideCita(estado) {
    if (estado) {
        return "none";
    }
    return "inherit";
}

function cancelarR(id) {
    $('.modal').modal('hide');
    if (confirm("¿Está seguro que desea cancelar este calendario?") == true) {
        $.ajax({
            url: '/estetica/public/reserva/cancelar/' + id ,
            type: 'POST',
            dataType: 'json',
            success: function(response) {
                $("#calendar").fullCalendar('removeEvents');
                $("#calendar").fullCalendar('refetchEvents');
                alert("Eliminado.");
            },
            error: function(response) {
                if (response.status == 400) {
                    alert(response.responseJSON.error);
                }
            }
        });
    }
}



function actualizarCal(today){
    var calendar = new Date($('#calendar').fullCalendar('getDate').format());
    if(today.getMonth() != calendar.getMonth()){
        $("#calendar").fullCalendar('refetchEvents');
    }
}

function calendario() {
    var today = new Date();
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'agendaWeek,agendaDay,listDay,listWeek'
        },
        views: {
            listDay: {
                buttonText: 'lista Diaria'
            },
            listWeek: {
                buttonText: 'lista Semanal'
            },
        },
        locale: 'es',
        navLinks: true, // can click day/week names to navigate views
        selectable: false,
        selectHelper: true,
        defaultView: 'agendaWeek',
        editable: true,
        hiddenDays: [0],
        allDayDefault: false,
        allDaySlot: false,
        minTime: "08:00:00",
        maxTime: "21:00:00",
        slotLabelFormat: 'H:mm',
        slotEventOverlap: false,
        eventLimit: true, // allow "more" link when too many events
        slotDuration: '00:15:00',
        eventClick: function(calEvent, jsEvent, view) {
            $('#cinfo').empty();
            $('#cinfo').html(`
                <h6>Cliente</h6>
                <span><b>Nombre:</b> ${calEvent.cliente.nombre}</span><br>
                <span><b>Correo electrónico:</b> ${calEvent.cliente.email}</span><br>
                <span><b>Telefono:</b> ${calEvent.cliente.telefono}</span><br>
                <span><b>DNI:</b> ${calEvent.cliente.identificacion}</span><br>
                <br><span><b>Tratamiento Reservado:</b> ${calEvent.tratamiento_nombre}</span><br>`);
            $('#mer').modal('show');
            $('#mer').on('hidden.bs.modal', function (e) {
                $('#fer')[0].reset();
                $('#fer').attr('action', $('#fer').attr('action').replace(calEvent.id, ':id'))
            });
            if(!calEvent.rotativo){
                $('#datetimepicker5').datepicker('destroy')
                $('#datetimepicker5').datepicker({
                    startDate: new Date(),
                    format:'yyyy-mm-dd',
                    language:  'es',
                    autoclose: true,
                });
                $('#datetimepicker7').datepicker('remove')
                $('#datetimepicker7').datetimepicker({
                    startView: 1,
                    format:'hh:ii',
                    language:  'es',
                    autoclose: true
                });
            }else{
                $('#datetimepicker5').datepicker('destroy')
                $('#datetimepicker5').datepicker({
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
                        return (calEvent.valid_days.indexOf(allDates) != -1?true:false);
                    }
                });
                $('#datetimepicker7').datepicker('remove')
                $('#datetimepicker7').datetimepicker({
                    startView: 1,
                    format:'hh:ii',
                    language:  'es',
                    autoclose: true
                });
            }
            $('#fer').attr('action', $('#fer').attr('action').replace(':id', calEvent.id));
            $('#fer').find('#datetimepicker5').val(calEvent.start._i.split(' ')[0]);
            $('#fer').find('#datetimepicker7').val(calEvent.start._i.split(' ')[1]);
            $('#fer').find('#datetimepicker6').val(calEvent.end._i);
            $('#fer').find('#sucursal_id').val(calEvent.sucursal_id);
            $('#fer').find('#user_id').val(calEvent.user_id);
            $('#fer').find('#estado').val(calEvent.estado);
            $('#fer').find('#cliente_tratamiento_id').val(calEvent.cliente_tratamiento_id);
        },
         eventDrop: function(event, delta, revertFunc) {
            if (!confirm("Esta seguro que quiere realizar este cambio?")) {
                revertFunc();
            }else {
                $.ajax({
                    url: '/estetica/public/reserva/editar/'+ event.id,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                      start: event.start.format("Y-MM-DD HH:mm:ss"),
                      end: event.end.format("Y-MM-DD HH:mm:ss")
                    },
                    success: function(response, status, jqXHR) {
                      alert("Guardado");
                    },
                    error: function(response, status, errorThrown) {
                        if (response.status == 403) {
                            alert(response.responseJSON.error);
                        }
                    }
                });
            }
        },
         eventResize: function(event, delta, revertFunc) {

            alert(event.title + " end is now " + event.end.format());

            if (!confirm("quiere hacer esto?")) {
                revertFunc();
            }else {
                $.ajax({
                    url: '/estetica/public/reserva/editar/'+ event.id,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                      start: event.start.format("Y-MM-DD HH:mm:ss"),
                      end: event.end.format("Y-MM-DD HH:mm:ss")
                    },
                    success: function(response, status, jqXHR) {
                      alert("Guardado");
                    },
                    error: function(response, status, errorThrown) {
                        if (response.status == 403) {
                            alert(response.responseJSON.error);
                        }
                    }
                });
            }
        },
        events: function(start, end, timezone, callback) {
            $(".full-height").show();
            var date = new Date($('#calendar').fullCalendar('getDate').format());
            $.ajax({
                url: '/estetica/public/reserva',
                type: 'GET',
                dataType: 'json',
                data: {
                  start: start.toISOString().split('T')[0],
                  end: end.toISOString().split('T')[0],
                  sucursal: $('#sucursal-filter').val(),
                  estado: $('#estado-filter').val()
                },
                success: function(response, status, jqXHR) {
                    var events = response;
                    for (var even of events) {
                        if(even.estado === 'realizada'){
                            even.color = '#00796B';
                        }
                        if(even.estado === 'cancelada'){
                            console.log('can');
                            even.color = '#455A64';
                        }
                    }

                    callback(events);
                    $(".full-height").hide();
                },
                error: function(response, status, errorThrown) {
                    if (response.status == 403) {
                        alert(response.responseJSON.error);
                    }
                    $(".full-height").hide();

                }
            });
        }
    });
    $('.fc-prev-button').click(function() {
        actualizarCal(today);
    });

    $('.fc-next-button').click(function() {
        actualizarCal(today);
    });

    $('#acc').click(function() {
        $("#mcc").modal('show');
        $('#mcc').on('hidden.bs.modal', function (e) {
            $('#fcc')[0].reset();
            $('#fcc').find('#datetimepicker1').val('');

        });
    });

    $('#aat').click(function() {
        $('#datatable-clientes').DataTable().ajax.reload();
        $("#mat").modal('show');
    });

    $('#acr').click(function() {
        $("#mcr").modal('show');
        $('#mcr').on('hidden.bs.modal', function (e) {
            $('#fcr')[0].reset();
            $('#selectCliente, #selectT, #sucursal_id, #user_id').select2('val', -1);
            $('#startBlock').text('');
        });
    });

    $('#aab').click(function() {
        $("#mab").modal('show');
        $('#mab').on('hidden.bs.modal', function (e) {
            $('#fab')[0].reset();
            $('#selectCliente2, #selectT2').select2('val', -1);
        });
    });

    $('#sucursal-filter').change(function() {
        $("#calendar").fullCalendar('refetchEvents');
    })
    $('#estado-filter').change(function() {
        $("#calendar").fullCalendar('refetchEvents');
    })
}

function afcc(close){
    if($("#fcc")[0].checkValidity()) {
        $('#fcc').ajaxSubmit({
            success: function () {
                $('#datatable-clientes').DataTable().ajax.reload();
                $("#mcc").modal('hide');
                if(!close){
                    $("#mat").modal('show');
                }
                $("#fcc")[0].reset();
            },
            error: function () {
                console.log('error');
            }
        });
    }else {
        alert('Los campos no son validos')
    }
}

function afcr(){
    if($("#fcr")[0].checkValidity()) {
        $('#fcr').ajaxSubmit({
            success: function () {
                $("#mcr").modal('hide');
                $('#fcr')[0].reset();
                $("#calendar").fullCalendar('refetchEvents');
            },
            error: function () {
                console.log('error');
            }
        });
    }else {
        alert('Los campos no son validos')
    }
}

function afcr2(){
    if($("#fcr")[0].checkValidity()) {
        $('#fcr').ajaxSubmit({
            success: function () {
                $('#fcr').find('#sucursal_id').select2('val', -1);
                $('#fcr').find('#datetimepicker2').val('');
                $('#fcr').find('#valor').val('');
                $('#fcr #startBlock').text('');
                $("#calendar").fullCalendar('refetchEvents');
            },
            error: function () {
                console.log('error');
            }
        });
    }else {
        alert('Los campos no son validos')
    }
}

function afer(){
    if($("#fer")[0].checkValidity()) {
        $('#fer').ajaxSubmit({
            success: function () {
                $("#mer").modal('hide');
                $("#fer")[0].reset();
                $("#calendar").fullCalendar('refetchEvents');
            },
            error: function () {
                console.log('error');
            }
        });
    }else {
        alert('Los campos no son validos')
    }
}
function afab(){
    if($("#fab")[0].checkValidity()) {
        $('#fab').ajaxSubmit({
            success: function () {
                $("#mab").modal('hide');
                $("#fab")[0].reset();
                $("#calendar").fullCalendar('refetchEvents');
            },
            error: function (e) {
                alert(e.responseText);
                $("#mab").modal('hide');
            }
        });
    }else {
        alert('Los campos no son validos')
    }
}

function attor(){
    $('#mat').modal('hide');
    $('#mcr').modal('show');
}

function asignar(cliente_id, name, urlD){
    var tratamiento_id = $('#tratamiento-filter-'+cliente_id).val();
    if(tratamiento_id != ''){
        if(confirm('Esta seguro de asignar el tratamiento '+$('#tratamiento-filter-'+cliente_id+' option:selected').text()+' al cliente '+name)){
            $.ajax({
                url: urlD,
                type: 'GET',
                data: {
                    c: cliente_id,
                    t: tratamiento_id
                },
                success: function(response, status, jqXHR) {
                    alert('Tratamiento asignado')
                },
                error: function(response, status, errorThrown) {
                    console.log(response);
                }
            });
        }
    }
}

function clienteTable(lan, url, fnSelect, fnBtn) {
    $('#datatable-clientes').DataTable({
        processing: true,
        serverSide: true,
        bLengthChange: false,
        language: {
            url: lan
        },
        ajax: url,
        columns: [
            { data: 'nombre', name: 'nombre' },
            { data: 'telefono', name: 'telefono' },
            { data: 'identificacion', name: 'identificacion' },
            { data: 'id', name: 'id', searchable: false, orderable: false, render: fnSelect},
            { data: 'id', name: 'id', searchable: false, orderable: false, render: fnBtn}
        ],
        drawCallback: function( settings ) {
            $('.select2filter').select2({ dropdownParent: $("#mat"), width: '230px'});
        }
    });
}

function ajaxGet(url, fnSuccess, fnError) {
    $.ajax({
        url: url,
        type: 'GET',
        success: fnSuccess,
        error: fnError,
    });
}
