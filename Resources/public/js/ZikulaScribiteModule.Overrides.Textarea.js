(function($) {
    $(document).ready(function() {
        // ajax handler for successful result
        var successHandler = function(result, message, request) {
            if (null !== result) {
                var container = $('#override-table-container');
                container.replaceWith(
                    $(result).find('#override-table-container').prepend('<div class="alert alert-success">'+Translator.__('Action successfully completed.')+'</div>')
                );
            }
        },
        // ajax handler for failure result
        errorHandler = function(request, message, detail) {
            console.log('FAILURE RESPONSE', {
                request: request,
                message: message,
                detail: detail
            })
        },
        // check to ensure user doesn't disable all textareas
        cannotDisableAll = function() {
            var parentRow = $(this).parents('tr');
            var textarea = parentRow.find('.all-check');
            var disable = parentRow.find('.disable-check');
            if (disable.is(':checked') && textarea.val().trim() === 'all') {
                alert('You may not disable all textareas. Simply unhook the module.');
                disable.prop('checked', false);
            }
        };

        // click handler for data submission via ajax
        $(document).on('click', '.ajaxsubmit', function(e) {
            e.preventDefault();
            $(this).parent().find('.ajaxsubmit').hide();
            $(this).parent().find('#spinner').show();
            var formArea = $(this).attr('id').split('_');
            var action = formArea.shift();
            var modname = formArea.shift();
            var zrowid = modname + '/' + formArea.join('_'); // just in case the id had underscores to begin with
            if (action.substr(0, 6) === 'delete') {
                var deleteConfirm = confirm('Are you sure you want to delete this item?');
                if (!deleteConfirm) {
                    return;
                }
                $(this).parents('tr').addClass('danger');
            } else if(action.substr(0, 9) === 'cancelAdd') {
                $(this).parents('tr').remove();
                return;
            }
            // fetch each input and hidden field and store the value to POST
            var pars = {};
            // '#' + thisForm.attr('id') +
            $.each($(':input, :hidden').serializeArray(), function(i, field) {
                pars[field.name] = field.value;
            });
            pars.action = action;
            pars.rowid = zrowid;

            $.ajax({
                url: $(this).closest('form').attr('action'),
                data: pars
            })
            .done(successHandler)
            .fail(errorHandler)
        });

        // click handler for adding another override
        $('#add-another-override').on('click', function(e) {
            e.preventDefault();
            var overridesTable = $('#overrides-table');
            // grab the prototype template
            var newWidget = overridesTable.attr('data-prototype');
            // replace the "__name__" used in the id and name of the prototype
            // with a number that's unique to your emails
            // end name attribute looks like name="contact[emails][2]"
            newWidget = newWidget.replace(/__name__/g, overrideCount);
            overrideCount++;
            // create a new list element and add it to the list
            var newRow = $('<tr class="success"></tr>').html(newWidget);
            newRow.appendTo(overridesTable.find('tbody'));
            $('.ajaxsubmit').tooltip();
        });

        $(document).on('mousedown', '.disable-select', function(e) {
            e.preventDefault();
        });
        $(document).on('click', '.disable-checkbox', function(e) {
            return false;
        });
        $(document).on('click', '.disable-check', cannotDisableAll);
        $(document).on('blur', '.all-check', cannotDisableAll);
    });
})(jQuery);
