/**
 * @license Copyright (c) 2003-2013, SimpleMedia - Erik Spaan. All rights reserved.
 */

CKEDITOR.plugins.add( 'simplemedia',
{
	requires: 'popup',
	lang: 'en,nl,de',
	init: function( editor )
	{
		editor.addCommand( 'insertSimpleMedia',
			{
				exec : function( editor )
				{    
                    var url = Zikula.Config.baseURL + Zikula.Config.entrypoint + '?module=SimpleMedia&type=external&func=finder&editor=ckeditor';
                    // call method in SimpleMedia_Finder.js and also give current editor
                    SimpleMediaFinderCKEditor(editor, url);
				}
			});
		editor.ui.addButton( 'SimpleMedia',
		{
			label: 'Insert SimpleMedia object',
			command: 'insertSimpleMedia',
			icon: this.path + 'images/ed_simplemedia.png'
		} );
	}
} );
