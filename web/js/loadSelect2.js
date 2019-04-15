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
	        placeholder: "Seleccione",
	        theme: "classic",
	        allowClear: true,
	        language: "es",
	    };
	}

    //If dropdown has data-ajax-url means is filled by ajax request on keypress
	if ($(dropdown).data('ajax-url')) {
		select2Conf.ajax = {
            url: $(dropdown).data('ajax-url'),
            dataType: 'json',
            delay: 250,
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
            success: function(data) {
                //Fills the destiny dropdown with the received data
                var datos = JSON.parse(data);

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