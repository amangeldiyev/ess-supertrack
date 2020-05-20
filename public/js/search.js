$(document).ready(function () {
    var options = {
        values: "a, b, c",
        // preserveSelected: false,
        ajax: {
            url: "/passengers/search",
            type: "GET",
            dataType: "json",
            data: {
                q: "{{{q}}}"
            }
        },
        locale: {
            emptyTitle: "Select and Begin Typing",
            statusInitialized: '',
            statusNoResults: '',
            statusSearching: ''
        },
        log: 0,
        preprocessData: function (data) {
            var i,
                l = data.length,
                array = [];
            if (l) {
                for (i = 0; i < l; i++) {
                    array.push(
                        $.extend(true, data[i], {
                            text: data[i].name,
                            value: data[i].id,
                            data: {
                                subtext: data[i].phone
                            }
                        })
                    );
                }
            }

            return array;
        }
    };

    $("#ajax-select")
        .selectpicker()
        .filter(".with-ajax")
        .ajaxSelectPicker(options);
    $("select").trigger("change");

    function chooseSelectpicker(index, selectpicker) {
        $(selectpicker).val(index);
        $(selectpicker).selectpicker('refresh');
    }

    $('#ajax-select').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
        $('input[name=phone]').val(e.target[clickedIndex].dataset.subtext)
        $('input[name=passenger]').val(e.target[clickedIndex].text)
    });
      
});