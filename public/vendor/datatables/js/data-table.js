jQuery(document).ready(function($) {
    'use strict';

    /* Calender jQuery **/

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

    if ($("table.first").length) {

        $(document).ready(function() {
            var table = $('table.first').DataTable({
                lengthChange: false,
                bPaginate: false,
                ordering: false,
                bFilter: false,
                bInfo: false,
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
});