(function() {

	var pluginName = 'lightbox';

	CKEDITOR.plugins.add(pluginName, {
        lang : 'en,pl',
		init : function(editor) {

			editor.addCommand(pluginName,new CKEDITOR.dialogCommand( 'lightbox' ));

			CKEDITOR.dialog.add(pluginName, this.path + 'dialogs/lightbox.js' );

			editor.ui.addButton('lightbox', {
				label : editor.lang.lightbox.label,
				command : pluginName,
				icon : this.path + 'icon.png'
			});
		}
	});

})();
