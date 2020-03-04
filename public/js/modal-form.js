function toggleModal(id) {
            
    $('#form-modal .modal-title').text(id ? 'Edit Taxi Request' : 'New Taxi Request');
    $('#form-modal .modal-body').html('<div class="mx-auto" style="width: 200px;"><span class="dashboard-spinner spinner-xxl"></span></div>');
    $('#form-modal').modal('toggle');

    $.ajax({
        url: id ? "/taxi-requests/"+ id + "/edit" : "/taxi-requests/create",
    }).done(function(response) {
        
        $('#form-modal .modal-body').html(response)

        if ($("#datetimepicker1").length) {
            $('#datetimepicker1').datetimepicker({
                format: 'DD/MM/YYYY',
                icons: {
                    time: "far fa-clock",
                    date: "fa fa-calendar-alt",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down",
                    today: 'fas fa-history',
                },
                daysOfWeekDisabled: [],
                defaultDate: $('#datetimepicker1').data('default'),
                buttons: {
                    showToday: true,
                    showClear: false,
                    showClose: true
                }
            });
    
        }
        if ($("#datetimepicker2").length) {
            $('#datetimepicker2').datetimepicker({
                format: 'DD/MM/YYYY HH:mm',
                icons: {
                    time: "far fa-clock",
                    date: "fa fa-calendar-alt",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down",
                    today: 'fas fa-history',
                },
                daysOfWeekDisabled: [],
                defaultDate: $('#datetimepicker2').data('default'),
                buttons: {
                    showToday: true,
                    showClear: false,
                    showClose: true
                }
            });
    
        }
        if ($("#datetimepicker3").length) {
            $('#datetimepicker3').datetimepicker({
                format: 'DD/MM/YYYY HH:mm',
                icons: {
                    time: "far fa-clock",
                    date: "fa fa-calendar-alt",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down",
                    today: 'fas fa-history',
                },
                daysOfWeekDisabled: [],
                defaultDate: $('#datetimepicker3').data('default'),
                buttons: {
                    showToday: true,
                    showClear: false,
                    showClose: true
                }
            });
    
        }
        if ($("#datetimepicker4").length) {
            $('#datetimepicker4').datetimepicker({
                format: 'DD/MM/YYYY HH:mm',
                icons: {
                    time: "far fa-clock",
                    date: "fa fa-calendar-alt",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down",
                    today: 'fas fa-history',
                },
                defaultDate: $('#datetimepicker4').data('default'),
                buttons: {
                    showToday: true,
                    showClear: false,
                    showClose: true
                }
            });
    
        }
        if ($("#datetimepicker5").length) {
            $('#datetimepicker5').datetimepicker({
                format: 'DD/MM/YYYY HH:mm',
                icons: {
                    time: "far fa-clock",
                    date: "fa fa-calendar-alt",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down",
                    today: 'fas fa-history',
                },
                defaultDate: $('#datetimepicker5').data('default'),
                buttons: {
                    showToday: true,
                    showClear: false,
                    showClose: true
                }
            });
    
        }
        if ($("#datetimepicker6").length) {
            $('#datetimepicker6').datetimepicker({
                format: 'DD/MM/YYYY HH:mm',
                icons: {
                    time: "far fa-clock",
                    date: "fa fa-calendar-alt",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down",
                    today: 'fas fa-history',
                },
                defaultDate: $('#datetimepicker6').data('default'),
                buttons: {
                    showToday: true,
                    showClear: false,
                    showClose: true
                }
            });
    
        }

    }).fail(function(e) {
        console.log(e)
    })
}

document.onkeydown = function (e) {

    e = e || window.event;

    if (e.keyCode == 112) {
        e.preventDefault()

        toggleModal(0)
    }
}