$.fn.modal.Constructor.prototype.enforceFocus = function() {};

/**
 * Activates the Select2 plugin for a specific dropdown
 */
var loadSelect2 = function(dropdown) {
    var select2Conf = {};

    //If the body has data-select2DefaultConf, this is used to configure the Select2
    if ($("body").data('select2DefaultConf')) {
        select2Conf = Object.assign({}, $("body").data('select2DefaultConf'));
    } else {
        select2Conf = {
            placeholder: "Select",
            theme: "classic",
            allowClear: true,
            language: "en",
        };
    }

    //If is a multiple dropdown the allowClear is false to avoid deplaced options
    if (typeof $(dropdown).attr('multiple') != "undefined") {
        select2Conf.allowClear = false;
    }

    //If dropdown has data-ajax-url means is filled by ajax request on keypress
    if ($(dropdown).data('ajax-url')) {
        select2Conf.ajax = {
            url: $(dropdown).data('ajax-url'),
            dataType: 'json',
        };
        select2Conf.minimumInputLength = 3;
    }

    //If data-placeholder is defined the dropdown placeholder text is changed
    if ($(dropdown).data('placeholder')) {
        select2Conf.placeholder = $(dropdown).data('placeholder');
    }

    //Select2 is activated
    $(dropdown).select2(select2Conf).on('select2:unselecting', function(e) {
        $(dropdown).data('unselecting', true);
    }).on('select2:open', function(e) {
        if ($(dropdown).data('unselecting')) {    
            $(dropdown).removeData('unselecting');
            $(dropdown).select2('close');
        }
    });
}

/**
 * When a dropdown with class "has-dependent-dropdown" triggers the change event
 * an ajax request is send to fill the dependent dropdown
 */
$(document).on("change", ".has-dependent-dropdown", function(){
    var undef = "undefined";
    var self = $(this);
    var dataDepen = $(this).data('dependent');

    //Checks if data-dependent is not defined in the dropdown or is empty
    if (typeof dataDepen == undef || $.isEmptyObject(dataDepen)) {
        return false;
    }

    $.each(dataDepen, function(index, row) {
        //The url, data and destiny attribute are required
        if (typeof row.url == undef || typeof row.data == undef || typeof row.destiny == undef) {
            return;
        }

        var destiny = $("#" + row.destiny);
        var data = {};
        var allEmpty = true;

        //Collects the values of all the elements passed in data attributes
        $.each(row.data, function(index, param) {
            var val = (param == "this") ? self.val() : $("#" + param).val();
            data[index] = val;

            if (val != "") {
                allEmpty = false;
            }
        });

        //Makes the ajax request
        $.ajax({
            url: row.url,
            type: (typeof row.type == undef) ? "get" : row.type,
            data: data,
            beforeSend: function(jqXHR) {
                //Clear the destiny dropdown, leaving the prompt
                destiny.find("option").filter(function() {
                    return $(this).val() != "";
                }).each(function() {
                    $(this).remove();
                });

                //If all the elements defined in the data attribute are empty, the request is not sent
                //and the destiny change event is triggered
                if (allEmpty) {
                    jqXHR.abort();
                    destiny.trigger("change");
                }
            },
            success: function(data, textStatus, jqXHR) {
                //Fills the destiny dropdown with the received data
                var datos = null;

                if (typeof jqXHR.responseJSON != "undefined") {
                    datos = data;
                } else {
                    datos = JSON.parse(data);
                }

                $.each(datos.results, function(){
                    destiny.append($("<option>", {
                        "text": this.text,
                        "value": this.id,
                    }));
                });

                //Triggers the destiny change event
                destiny.trigger("change");
            }
        });
    });
});


/**
 * Event attached to the selects allowing to reload its options
 */
$(document).on("reload-select-options", "select", function(e, callback) {
    var dropdown = $(this);
    var url = dropdown.data('reload-url');
    var reloadData = dropdown.data('reload-data');

    if (typeof url == "undefined") {
        return false;
    }

    var data = {};

    if (typeof reloadData != "undefined") {
        $.each(reloadData, function(name, value) {
            //Check if is an ID
            if (/^\#.+/.test(value)) {
                data[name] = $(value).val();
            } else {
                data[name] = value;
            }
        });
    }

    var jqXHR = $.ajax({
        url: url,
        type: 'get',
        data: data,
        beforeSend: function() {
            dropdown.find('option').filter(function(index, element) {
                return $(element).val() != "";
            }).each(function(index, element) {
                element.remove();
            });
        },
        success: function(data) {
            $.each(data.results, function(index, row) {
                var opt = new Option(row.text, row.id, false, false);
                dropdown.append(opt);
            });

            dropdown.trigger('change');
        },
        complete: function() {
            if (typeof callback == "function") {
                callback();
            }
        }
    });

    return jqXHR;
});