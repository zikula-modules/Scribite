// Make sure to work with jcss combination enabled.
window.CKEDITOR_GETURL = function (path) {
    if (path.indexOf('modules/Scribite') < 0) {
        return 'modules/Scribite/plugins/CKEditor/vendor/ckeditor/' + path;
    }

    // That's a full path.
    return path;
};
