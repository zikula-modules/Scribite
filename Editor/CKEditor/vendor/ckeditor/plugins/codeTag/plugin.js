CKEDITOR.plugins.add( 'codeTag', {
  icons: 'code',
  init: function( editor ) {
    editor.addCommand( 'wrapCode', {
      exec: function( editor ) {
        editor.insertHtml( '<code>' + editor.getSelection().getSelectedText() + '</code>' );
      }
    });
    editor.ui.addButton( 'Code', {
      label: editor.config.language == 'bg' ? 'Блок код с избраното' : 'Wrap selection with code tag',
      command: 'wrapCode',
      toolbar: 'blocks' // insert
    });
  }
});