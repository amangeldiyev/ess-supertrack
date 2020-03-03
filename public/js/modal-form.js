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
                    down: "fa fa-arrow-down"
                },
                daysOfWeekDisabled: [],
                defaultDate: $('#datetimepicker1').data('default'),
            })

        }
        if ($("#datetimepicker2").length) {
            $('#datetimepicker2').datetimepicker({
                format: 'DD/MM/YYYY HH:mm',
                icons: {
                    time: "far fa-clock",
                    date: "fa fa-calendar-alt",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                },
                daysOfWeekDisabled: [],
                defaultDate: $('#datetimepicker2').data('default'),
            })

        }
        if ($("#datetimepicker3").length) {
            $('#datetimepicker3').datetimepicker({
                format: 'DD/MM/YYYY HH:mm',
                icons: {
                    time: "far fa-clock",
                    date: "fa fa-calendar-alt",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                },
                daysOfWeekDisabled: [],
                defaultDate: $('#datetimepicker3').data('default'),
            })

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