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
                allowInputToggle: true,
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
                viewMode: 'times',
                stepping: 5,
                allowInputToggle: true,
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
                viewMode: 'times',
                stepping: 5,
                allowInputToggle: true,
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
                format: 'HH:mm',
                allowInputToggle: true,
                icons: {
                    time: "far fa-clock",
                    date: "fa fa-calendar-alt",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down",
                    today: 'fas fa-history',
                },
                buttons: {
                    showToday: true,
                    showClear: false,
                    showClose: true
                }
            });
    
        }
        if ($("#datetimepicker5").length) {
            $('#datetimepicker5').datetimepicker({
                format: 'HH:mm',
                allowInputToggle: true,
                icons: {
                    time: "far fa-clock",
                    date: "fa fa-calendar-alt",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down",
                    today: 'fas fa-history',
                },
                buttons: {
                    showToday: true,
                    showClear: false,
                    showClose: true
                }
            });
    
        }
        if ($("#datetimepicker6").length) {
            $('#datetimepicker6').datetimepicker({
                format: 'HH:mm',
                allowInputToggle: true,
                icons: {
                    time: "far fa-clock",
                    date: "fa fa-calendar-alt",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down",
                    today: 'fas fa-history',
                },
                buttons: {
                    showToday: true,
                    showClear: false,
                    showClose: true
                }
            });
    
        }

        document.getElementById("ajax-select").focus();

    }).fail(function(e) {
        console.log(e)
    })
}

function submitForm(e, id, status = false) {
    e.preventDefault()

    let filter = window.location.search.split('filter=')[1]
    let from = window.location.search.split('from=')[1] ?? ''
    let to = window.location.search.split('to=')[1] ?? ''
    let data = $(e.target).serialize() + '&filter=' + filter + '&from=' + from + '&to=' + to

    if (status) {
        data = data + '&status=' + status
    }

    $.ajax({
        url: $(e.target).attr('action'),
        method: id ? "PUT" : "POST",
        data: data,
    }).done(function(response) {
        if(filter || from) {
            $('#table-wrapper').html(response)
    
            if ($("table.second").length) {
    
                $(document).ready(function() {
                    var table = $('table.second').DataTable({
                        lengthChange: false,
                        ordering: false,
                        buttons: [
                            {
                                extend: 'pdfHtml5',
                                orientation: 'landscape',
                                pageSize: 'A4'
                            },
                            'copy', 'excel', 'print', 'colvis'
                        ]
                    });
        
                    table.buttons().container()
                        .appendTo('#example_wrapper .col-md-6:eq(0)');
                });
            }
        }

        $('#form-modal').modal('toggle')
    }).fail(function(e) {
        
        let errors = e.responseJSON.errors

        if (e.status == 422) {
            for (const error in errors) {
                $(`input[name='${error}']`).addClass('is-invalid');
                $(`#error_${error}`).text(errors[error]);
            }
        }
    })
}

function assignDriver(id) {
    $('#form-modal .modal-title').text('Set Driver');
    $('#form-modal .modal-body').html('<div class="mx-auto" style="width: 200px;"><span class="dashboard-spinner spinner-xxl"></span></div>');
    $('#form-modal').modal('toggle');

    $.ajax({
        url: "/taxi-requests/"+ id + "/assign-driver",
    }).done(function(response) {
        
        $('#form-modal .modal-body').html(response)

    }).fail(function(e) {
        console.log(e)
    })
}

function assignVehicle(id) {
    $('#form-modal .modal-title').text('Set Vehicle');
    $('#form-modal .modal-body').html('<div class="mx-auto" style="width: 200px;"><span class="dashboard-spinner spinner-xxl"></span></div>');
    $('#form-modal').modal('toggle');

    $.ajax({
        url: "/taxi-requests/"+ id + "/assign-vehicle",
    }).done(function(response) {
        
        $('#form-modal .modal-body').html(response)

    }).fail(function(e) {
        console.log(e)
    })
}

function updateStatus(id, status, statusText) {
    $('#form-modal .modal-title').text(statusText);
    $('#form-modal .modal-body').html('<div class="mx-auto" style="width: 200px;"><span class="dashboard-spinner spinner-xxl"></span></div>');
    $('#form-modal').modal('toggle');

    $.ajax({
        url: "/taxi-requests/"+ id + "/updateStatus",
        data: {status: status}
    }).done(function(response) {
        
        $('#form-modal .modal-body').html(response)

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