jQuery(document).ready(function($) {
    'use strict';

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
        });

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
        });

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
        });

    }
});