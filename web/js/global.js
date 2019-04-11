/*
 * When clicking a link loads the view in a modal
 */
$(document).on("click", ".link-for-modal", function(e) {
    e.preventDefault();

    //url to get the modal content
    var url = $(this).attr('href');

    //Ajax method
    var method = $(this).data('method') ? $(this).data('method') : 'get';

    //Modal title
    var title = $(this).data('title') ? $(this).data('title') : '';

    //Hide the modal save button
    var hideSave = typeof $(this).data('hide-save') != "undefined" ? true : false;

    //Current modal (if the view is inside a modal)
    var currentModal = $(this).parents('.modal');

    //Target modal (where the view is going to be rendered)
    var targetModal = (typeof ($(this).data('target-modal')) != "undefined") ? $( $(this).data('target-modal') ) : $("#main-modal");

    //If the content is a form for a catalog table
    var callCatalogForm = typeof ($(this).data('call-catalog-form')) != "undefined";

    //The button that trigger the modal call
    var triggerBtn = callCatalogForm ? $(this).attr('id') : null;

    //The dropdown to fill with the catalog
    var targetDropdown = callCatalogForm ? $(this).parents('.form-group').find('select').attr('id') : null;

    $.ajax({
        url: url,
        type: method,
        beforeSend: function(jqXHR, settings) {
            targetModal.find('.modal-title').html(title);
            targetModal.find('.modal-body').html('<center><div class="loader"></div></center>');

            if (hideSave) {
                targetModal.find('.modal-save-btn').hide();
            } else {
                targetModal.find('.modal-save-btn').show();
            }

            if (currentModal.length > 0) {
                //When the current modal is closed, after finishing the animation, open the next modal
                var showNext = function() {
                  targetModal.modal('show');
                  currentModal.off("hidden.bs.modal", showNext);
                }

                currentModal.on("hidden.bs.modal", showNext).modal('hide');

                //When the target modal is closed, after finishing the animation, open the previous modal
                var showPrev = function() {
                  currentModal.modal('show');
                  targetModal.off("hidden.bs.modal", showPrev);
                }

                targetModal.on("hidden.bs.modal", showPrev).modal('hide');
            } else {
                targetModal.modal('show');
            }

        },
        success: function(data, textStatus, jqXHR) {
            targetModal.find('.modal-body').html(data).find('select').each(function() {
                loadSelect2(this);
            }).end().data('triggerBtn', triggerBtn).data('targetDropdown', targetDropdown);
        }, 
    });
    return false;
});

/*
 * The modal save button, triggers the modal form submit
 */
$(document).on("click", ".modal-save-btn", function() {
    var form = $(this).parents('.modal').find("form");
    
    if (form.length > 0) {
        form.submit();
    }
});

/*
 * Catalog modal form submit
 */
$(document).on("submit", ".modal .catalog-form", function(e) {
    e.preventDefault();

    var form = $(this);
    var url = form.attr('action');
    var data = form.serialize();
    var modal = form.parents('.modal');
    var triggerBtn = form.parents('.modal-body').data('triggerBtn');
    var targetDropdown = form.parents('.modal-body').data('targetDropdown');

    $.ajax({
        url: url,
        data: data,
        type: 'post',
        beforeSend: function(jqXHR, settings) {
            modal.find(".modal-body").html('<center><div class="loader"></div></center>');
            modal.modal("show");
        },
        success: function(result, textStatus, jqXHR) {
            if (result != "close-modal") {
                modal.find(".modal-body").html(result);
                modal.find(".modal-body").find('select').each(function() {
                    loadSelect2(this);
                });
            } else {
                modal.modal("hide");

                var addBtn = $("#" + triggerBtn);
                var dropdown = $("#" + targetDropdown);

                addBtn.children('i').first().removeClass('fas fa-plus')
                    .addClass('fas fa-sync-alt fa-spin');
                dropdown.prop("disabled", true);

                dropdown.trigger('reload-select-options', function() {
                    dropdown.prop("disabled", false);
                    addBtn.children('i').first().removeClass('fas fa-sync-alt fa-spin')
                        .addClass('fas fa-plus');
                });
            }
        }
    });

    return false;
});

/*
 * Modal form submit
 */
$(document).on("submit", ".modal form:not(.catalog-form)", function(e) {
    e.preventDefault();

    var form = $(this);
    var url = form.attr('action');
    var data = form.serialize();
    var modal = form.parents('.modal');

    $.ajax({
        url: url,
        data: data,
        type: 'post',
        beforeSend: function(jqXHR, settings) {
            modal.find(".modal-body").html('<center><div class="loader"></div></center>');
            modal.modal("show");
        },
        success: function(result, textStatus, jqXHR) {
            if (result != "close-modal") {
                modal.find(".modal-body").html(result);
                modal.find(".modal-body").find('select').each(function() {
                    loadSelect2(this);
                });
            } else {
                modal.modal("hide");
                location.reload();
            }
        }
    });

    return false;
});