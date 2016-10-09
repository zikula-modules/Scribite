(function($) {
    $(document).ready(function() {
        // ajax handler for successful result
        var successHandler = function(result, message, request) {
            if (null !== result.data) {
                rowHandler(result.data);
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
        clearform = function(ele) {
            $(ele).find(':input').each(function() {
                switch (this.type) {
                    case 'text':
                    case 'select-one':
                        $(this).val('');
                        break;
                    case 'checkbox':
                        this.checked = false;
                }
            })
        },
        disableFormElements = function(ele) {
            $(ele).find(':input').each(function() {
                $(this).prop('disabled', true);
            })
        },
        rowHandler = function(data) {
            var newRow;
            switch (data.action) {
                case 'submitTextareaOverride':
                    var disabledChecked = (data.disabled == 'true');
                    var idSuffix = data.modname + data.area;
                    // create new row and insert new ids and values and re-id buttons
                    newRow = $('#ai_textareaoverride').clone(true)
                        .find('#ai_module').attr('id', 'module_' + idSuffix).val(data.modname).end()
                        .find('#ai_area').attr('id', 'area_' + idSuffix).val(data.area).end()
                        .find('#ai_params').attr('id', 'params_'+idSuffix).val(data.params).end()
                        .find('#ai_disabled').attr('id', 'disabled_' + idSuffix).prop('checked', disabledChecked).end()
                        .find('#ai_modifyTextareaOverride').attr('id', 'modifyTextareaOverride_' + idSuffix).end()
                        .find('#ai_editTextareaOverride').attr('id', 'editTextareaOverride_' + idSuffix).end()
                        .find('#ai_deleteTextareaOverride').attr('id', 'deleteTextareaOverride_' + idSuffix).end()
                        .removeAttr('id');
                    // insert the row at the end of the table before the 'newtextarea' row
                    $('#newtextarea').before(newRow);
                    // display the row & highlight
                    newRow.show().effect('highlight', 2000);
                    // remove #moduleoverridesempty row
                    if ($('#textareaoverridesempty').is(':visible')) {
                        $('#textareaoverridesempty').hide();
                    }
                    // clear the 'new' row
                    clearform('#newtextarea');
                    break;
                case 'submitModuleOverride':
                    // create new row and insert new ids and values and re-id buttons
                    newRow = $('#ai_moduleoverride').clone(true)
                        .find('#ai_module').attr('id', 'module_' + data.modname).val(data.modname).end()
                        .find('#ai_editor').attr('id', 'editor_' + data.modname).val(data.editor).end()
                        .find('#ai_modifyModuleOverride').attr('id', 'modifyModuleOverride_'+data.modname).end()
                        .find('#ai_editModuleOverride').attr('id', 'editModuleOverride_'+data.modname).end()
                        .find('#ai_deleteModuleOverride').attr('id', 'deleteModuleOverride_'+data.modname).end()
                        .removeAttr('id');
                    // insert the row at the end of the table before the 'newtextarea' row
                    $('#newmodule').before(newRow);
                    // display the row & highlight
                    newRow.show().effect('highlight', 2000);
                    // remove #moduleoverridesempty row
                    if ($('#moduleoverridesempty').is(':visible')) {
                        $('#moduleoverridesempty').hide();
                    }
                    // clear the 'new' row
                    clearform('#newmodule');
                    break;
                case 'modifyTextareaOverride':
                case 'modifyModuleOverride':
                    // disabled the form fields
                    $('#module_' + data.rowid).parents('tr').find(':input').each(function() {
                        $(this).prop('disabled', true);
                    })
                    // swith the button states
                    $('#' + data.action + '_' + data.rowid).hide();
                    $('#editModuleOverride_' + data.rowid).show();
                    $('#editTextareaOverride_' + data.rowid).show();
                    break;
            }
        };

        // click handler for data submission via ajax
        $('.ajaxsubmit').click(function() {
            var formArea = $(this).attr('id').split('_');
            var action = formArea.shift();
            var zrowid = formArea.join('_'); // just in case the id had underscores to begin with
            if (action.substr(0, 4) == 'edit') {
                // re-enable form fields (except module & textarea)
                $('#editor_' + zrowid).prop('disabled', false);
                $('#disabled_' + zrowid).prop('disabled', false);
                $('#params_' + zrowid).prop('disabled', false);
                // replace edit icon with submit
                $(this).hide();
                $('#modifyTextareaOverride_' + zrowid).show();
                $('#modifyModuleOverride_' + zrowid).show();
                return;
            } else if (action.substr(0, 6) == 'delete') {
                var deleteConfirm = confirm('Are you sure you want to delete this item?');
                if (!deleteConfirm) {
                    return;
                }
                // hide the parent row (fake delete)
                $(this).parents('tr').hide();
            }
            var post = {
                action: action,
                rowid: zrowid,
                modname: $('#module_' + zrowid).val(),
                editor: $('#editor_' + zrowid).val(),
                area: $('#area_' + zrowid).val(),
                disabled: $('#disabled_' + zrowid).is(':checked'),
                params: $('#params_' + zrowid).val()
            }
            $.ajax('ajax.php?module=Scribite&type=ajax&func=submitoverride', {
                data: post
            }).done(successHandler)
            .fail(errorHandler);
        });

        $('#disabled_0').click(cantDisableAll);
        $('#area_0').blur(cantDisableAll);

        var cantDisableAll = function() {
            if ($('#disabled_0').is(':checked') && $('#area_0').val() == 'all') {
                alert('You may not disable all textareas. Simply unhook the module.');
                $('#disabled_0').prop('checked', false);
            }
        }
    });
})(jQuery)
