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

    calendario();
});

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

function formModal(data, self) {
    var formTemplete = "";
    if (data.asignacionCita == null) {
        formTemplete = `<div class="modal modal-c" id="formModal">
        <div class="modal-content">
        <div class="collection">
            <a href="#!" class="collection-item"  onclick="asignarAlmuerzo(${data.id}, ${data.almuerzo})"><i class="material-icons">local_dining</i>${des(data.almuerzo)} almuerzo</a>
            <a href="#!" class="collection-item" onclick="listaMedicos(${data.id}, ${data.medico})"><i class="material-icons">person</i>Asignar Medico</a>
            <a href="#!" class="collection-item" onclick="eliminarCalendario(${data.id})"><i class="material-icons">delete</i>Eliminar</a>
        </div>
        </div>
        </div>`;
    } else {
        formTemplete = `<div class="modal modal-c" id="formModal">
        <div class="modal-content">
        <div class="collection">
            <a href="#!" class="collection-item" onclick="listaMedicos(${data.id}, ${data.medico})"><i class="material-icons">person</i>Asignar Medico</a>
        </div>
        </div>`;
    }

    var query = $("#formModal");
    if (query.length === 0) {
        $("body").append(formTemplete);
    } else {
        query.remove();
        $("body").append(formTemplete);
    }
    $("#formModal").modal({
        ready: function(modal, trigger) {
            $('.tooltipped').tooltip({
                delay: 50,
                position: 'right'
            });
        }
    });
    $('#formModal').modal('open');
}


function eliminarCalendario(id) {
    $('#formModal').modal('close');
    if (confirm("¿Está seguro que desea borrar este calendario?") == true) {
        $.ajax({
            url: '/agenda/calendario/form/' + id + '/',
            type: 'POST',
            dataType: 'json',
            data: {
                eliminado: true
            },
            success: function(response) {
                $("#calendar").fullCalendar('removeEvents');
                $("#calendar").fullCalendar('refetchEvents');
                Materialize.toast('Borrado exitoso.', 2000);
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
            right: 'agendaWeek,agendaDay'
        },
        locale: 'es',
        navLinks: true, // can click day/week names to navigate views
        selectable: true,
        selectHelper: true,
        defaultView: 'agendaWeek',
        editable: false,
        hiddenDays: [0],
        allDayDefault: false,
        allDaySlot: false,
        minTime: "08:00:00",
        maxTime: "21:00:00",
        slotLabelFormat: 'h(:mm)a',
        slotEventOverlap: false,
        eventLimit: true, // allow "more" link when too many events
        slotDuration: '00:15:00',
        events: [
        {
          title: 'All Day Event',
          start: '2017-12-01',
        },
        {
          title: 'Long Event',
          start: '2017-12-07',
          end: '2017-12-10'
        },
        {
          id: 999,
          title: 'Repeating Event',
          start: '2017-12-09T16:00:00'
        },
        {
          id: 999,
          title: 'Repeating Event',
          start: '2017-12-16T16:00:00'
        },
        {
          title: 'Conference',
          start: '2017-12-12',
          end: '2017-12-13'
        },
        {
          title: 'Meeting',
          start: '2017-12-12T10:30:00',
          end: '2017-12-12T12:30:00'
        },
        {
          title: 'Lunch',
          start: '2017-12-12T12:00:00'
        },
        {
          title: 'Meeting',
          start: '2017-12-12T14:30:00'
        },
        {
          title: 'Happy Hour',
          start: '2017-12-12T17:30:00'
        },
        {
          title: 'Dinner',
          start: '2017-12-12T20:00:00'
        },
        {
          title: 'Birthday Party',
          start: '2017-12-13T07:00:00'
        },
        {
          title: 'Click for Google',
          url: 'http://google.com/',
          start: '2017-12-28'
        }
      ],
        select: function(start, end) {
            var fecha1 = new Date(start.format()),
                fecha2 = new Date(end.format()),
                resta = fecha2.getTime() - fecha1.getTime(),
                minutos = Math.round(resta / 60000);

          var eventData,
              data;
          data = {
              almuerzo: false,
              inicio: start.format('Y-MM-DD HH:mm:ss'),
              fin: end.format('Y-MM-DD HH:mm:ss')
          };
          alert("Esto es un select");
          //$(".full-height").show();
          // $.ajax({
          //     url: '/agenda/calendario/form/',
          //     type: 'POST',
          //     dataType: 'json',
          //     contentType: "application/json; charset=utf-8",
          //     data: JSON.stringify(data),
          //     success: function(response) {
          //         var data = response;
          //         if(data.medico_id != null){
          //             eventData = {
          //                 id: data.id,
          //                 almuerzo: data.almuerzo,
          //                 medico: data.medico_id,
          //                 title: '(M) - Espacio para cita',
          //                 color: '#2196f3',
          //                 start: start,
          //                 end: end
          //             };
          //         }else{
          //             eventData = {
          //                 id: data.id,
          //                 almuerzo: data.almuerzo,
          //                 title: 'Espacio para cita',
          //                 color: '#2196f3',
          //                 start: start,
          //                 end: end
          //             };
          //         }
          //
          //         $('#calendar').fullCalendar('renderEvent', eventData, true);
          //         Materialize.toast('Guardado exitoso.', 1000);
          //         $(".full-height").hide();
          //
          //     },
          //     error: function(response) {
          //         if (response.status == 400) {
          //             if (response.responseJSON.fin) {
          //                 alert("Fecha final: " + response.responseJSON.fin[0]);
          //             }
          //             if (response.responseJSON.inicio) {
          //                 alert("Fecha inical: " + response.responseJSON.inicio[0]);
          //             }
          //             if (response.responseJSON.__all__) {
          //                 alert(response.responseJSON.__all__[0]);
          //             }
          //         } else if (response.status == 403) {
          //             alert(response.responseJSON.error);
          //         }
          //         $(".full-height").hide();
          //
          //     }
          // });
            $('#calendar').fullCalendar('unselect');
        },
        eventClick: function(calEvent, jsEvent, view) {
            console.log(calEvent);
            alert("Evento click");
            //formModal(calEvent, this);
            // change the border color just for fun
            //$(this).css('border-color', 'red');

        },
        // events: function(start, end, timezone, callback) {
        //     $(".full-height").show();
        //     var date = new Date($('#calendar').fullCalendar('getDate').format());
        //     $.ajax({
        //         url: '/agenda/calendario/list/',
        //         type: 'GET',
        //         dataType: 'json',
        //         data: {
        //             inicio__week: date.getWeek(),

        //         },
        //         success: function(response, status, jqXHR) {
        //             var events = response.object_list;
        //             callback(events);
        //             $(".full-height").hide();
        //         },
        //         error: function(response, status, errorThrown) {
        //             if (response.status == 403) {
        //                 alert(response.responseJSON.error);
        //             }
        //             $(".full-height").hide();

        //         }
        //     });
        // }
    });
    $('.fc-prev-button').click(function() {
        actualizarCal(today);
    });

    $('.fc-next-button').click(function() {
        actualizarCal(today);
    });
}
