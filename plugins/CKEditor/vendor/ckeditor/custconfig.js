/*
help: http://docs.cksource.com/ckeditor_api/symbols/CKEDITOR.config.html
*/

CKEDITOR.editorConfig = function( config )
{
    config.disableNativeSpellChecker = false;
    config.allowedContent = true;
    config.htmlEncodeOutput = false;
    config.entities = false;
    config.entities_greek = false;
    config.entities_latin = false;
    config.embed_provider = '//ckeditor.iframe.ly/api/oembed?url={url}&callback={callback}';
    config.fontawesomePath = 'view/javascript/font-awesome/css/font-awesome.min.css';
    config.htmlEncodeOutput = false;
    config.leaflet_maps_google_api_key = 'AIzaSyA9ySM6msnGm0qQB1L1cLTMBdKEUKPySmQ';
    config.startupOutlineBlocks = true;
    config.toolbarCanCollapse = true;
    config.forcePasteAsPlainText = false;
    config.dialog_noConfirmCancel = true;
    // below only for editor overwrites!
    config.toolbar_Basic =
    [
        { name: 'document',    items : [ 'Cut', 'Copy', 'PasteText', 'Link' ] },
        { name: 'basicstyles', items : [ 'Bold', 'Italic', 'Underline' ] },
        { name: 'paragraph',   items : [ 'JustifyLeft', 'JustifyCenter', 'JustifyRight' ] }
    ];
    config.toolbar_Simple =
    [
        { name: 'document',    items : [ 'Maximize', 'Source', 'Cut', 'Copy', 'PasteText', 'RemoveFormat', 'Link', 'Image', 'Imageplus', 'Youtube' ] },
        { name: 'basicstyles', items : [ 'Bold', 'Italic', 'Underline' ] },
        { name: 'paragraph',   items : [ 'NumberedList', 'BulletedList', 'JustifyLeft', 'JustifyCenter', 'JustifyRight' ] },
        { name: 'about',       items : [ 'About' ] }
    ];
    config.toolbar_Standard =
    [
        { name: 'document',    items : [ 'Maximize', 'Source', 'Preview' ] },
        { name: 'editing',     items : [ 'Cut', 'Copy', 'PasteText', 'RemoveFormat', 'Undo', 'Redo' ] },
        { name: 'tools',       items : [ 'Find', 'Replace', 'SpellChecker', 'Scayt' ] },
        { name: 'links',       items : [ 'Link', 'Unlink' ] },
        { name: 'insert',      items : [ 'Image', 'Imageplus', 'Youtube', 'Embed', 'MediaEmbed', 'Table', 'btgrid', 'HorizontalRule', 'Smiley', 'SpecialChar' ] },
        { name: 'about',       items : [ 'About' ] },
        '/',
        { name: 'basicstyles', items : [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript' ] },
        { name: 'paragraph',   items : [ 'NumberedList', 'BulletedList', 'Outdent', 'Indent', 'Blockquote', 'CreateDiv', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
        { name: 'styles',      items : [ 'Font', 'FontSize' ] },
        { name: 'colors',      items : [ 'TextColor', 'BGColor' ] }
    ];
    config.toolbar_Extended =
    [
        { name: 'document',    items : [ 'Maximize', 'Source', 'ShowBlocks', 'DocProps', 'Save', 'Preview' ] },
        { name: 'clipboard',   items : [ 'Cut', 'Copy', 'Paste', 'PasteText', 'RemoveFormat', 'Undo', 'Redo' ] },
        { name: 'editing',     items : [ 'googlesearch', 'Find', 'Replace', 'SpellChecker', 'Scayt' ] },
        { name: 'links',       items : [ 'Link', 'Unlink', 'Anchor' ] },
        { name: 'insert',      items : [ 'Image', 'Imageplus', 'Youtube', 'Iframe', 'Flash', 'Embed', 'MediaEmbed', 'Table', 'btgrid', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'wenzgmap' ] },
        '/',
        { name: 'basicstyles', items : [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript' ] },
        { name: 'paragraph',   items : [ 'NumberedList', 'BulletedList', 'Outdent', 'Indent', 'Blockquote', 'CreateDiv', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
        { name: 'styles',      items : [ 'Styles', 'Format', 'Font', 'FontSize' ] },
        { name: 'colors',      items : [ 'TextColor', 'BGColor' ] },
        { name: 'about',       items : [ 'About' ] }
    ];
};
