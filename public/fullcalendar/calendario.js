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

function formModal(data) {
    var formTemplete = "";
    formTemplete = `<div class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">${data.title}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="list-group">
              <a href="/estetica/public/reserva/${data.id}/edit" class="list-group-item list-group-item-action">Editar reserva</a>
              <a href="#" onclick="cancelarR(${data.id})" class="list-group-item list-group-item-action">Cancelar reserva</a>
            </div>
          </div>
          <div class="modal-footer">

          </div>
        </div>
      </div>
    </div>`;

    var query = $(".modal");
    if (query.length === 0) {
        $("body").append(formTemplete);
    } else {
        query.remove();
        $("body").append(formTemplete);
    }
    $(".modal").modal('show');
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
            right: 'agendaWeek,agendaDay'
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
        slotLabelFormat: 'h(:mm)a',
        slotEventOverlap: false,
        eventLimit: true, // allow "more" link when too many events
        slotDuration: '00:15:00',
        eventClick: function(calEvent, jsEvent, view) {
            console.log(calEvent);
            formModal(calEvent)
            //formModal(calEvent, this);
            // change the border color just for fun
            //$(this).css('border-color', 'red');

        },
         eventDrop: function(event, delta, revertFunc) {
           console.log(event);
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

            if (!confirm("is this okay?")) {
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
                  week: date.getWeek(),
                },
                success: function(response, status, jqXHR) {
                    console.log(response);
                    var events = response.data;
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
}
