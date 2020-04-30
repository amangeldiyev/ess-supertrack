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

        document.getElementById("passenger").focus();

    }).fail(function(e) {
        console.log(e)
    })
}

function submitForm(e, id) {
    e.preventDefault()

    $.ajax({
        url: id ? "/taxi-requests/" + id : "/taxi-requests",
        method: id ? "PUT" : "POST",
        data: $(e.target).serialize(),
    }).done(function(response) {

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

        $('#form-modal').modal('toggle')
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