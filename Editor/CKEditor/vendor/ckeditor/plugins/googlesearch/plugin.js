/*
 *  # Google Search Plugin for CKEditor #
 *
 *  (C) Copyright Prafull Ranjan (all rights reserverd)
 *  MIT License
 *
 *
*/


/*
* A ckeditor plugin to add google search button for searching selected word
* Use this plugin to extend ckeditor toolbar with the functionality of Google Search.
*/

CKEDITOR.plugins.add('googlesearch', {
    icons: 'googlesearch',
    init: function( editor ) {
        editor.addCommand( 'startSearch', {
            exec: function( editor ) {
                var sel = editor.getSelection();
                var url = "https://www.google.com/search?q="+sel.getSelectedText();
                window.open(url, '_blank');
            }
        });
        editor.ui.addButton( 'googlesearch', {
            label: editor.config.language == 'bg' ? 'Google търсене' : 'Google Search',
            id: 'googlesearch',
            command: 'startSearch',
            toolbar: 'find,1'
        } );
    }
} );
