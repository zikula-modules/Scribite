(function($) {
    var resizeEle = $('#scribiteeditor_ckeditor_resizemode');
    var agDetails = $('#sm_autogrow_details');
    var rsDetails = $('#sm_resize_details');
    $(document).ready(function() {
        switch (resizeEle.val()) {
            case 'resize':
                agDetails.addClass('d-none');
                break;
            case 'autogrow':
                rsDetails.addClass('d-none');
                break;
            case 'noresize':
                rsDetails.addClass('d-none');
                agDetails.addClass('d-none');
                break;
        }

        resizeEle.change(sm_sizing_onchange);
    });

    function sm_sizing_onchange()
    {
        switch (resizeEle.val()) {
            case 'resize':
                rsDetails.removeClass('d-none');
                agDetails.addClass('d-none');
                break;
            case 'autogrow':
                rsDetails.addClass('d-none');
                agDetails.removeClass('d-none');
                break;
            case 'noresize':
                rsDetails.addClass('d-none');
                agDetails.addClass('d-none');
                break;
        }
    }
})(jQuery);
