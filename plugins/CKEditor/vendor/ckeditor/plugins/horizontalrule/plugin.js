﻿/**
 * @license Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

/**
 * @fileOverview Horizontal Rule plugin.
 */

(function() {
	var horizontalruleCmd = {
		canUndo: false, // The undo snapshot will be handled by 'insertElement'.
		exec: function( editor ) {
			var hr = editor.document.createElement( 'hr' );
			editor.insertElement( hr );
		}
	};

	var pluginName = 'horizontalrule';

	// Register a plugin named "horizontalrule".
	CKEDITOR.plugins.add( pluginName, {
		lang: 'af,ar,bg,bn,bs,ca,cs,cy,da,de,el,en-au,en-ca,en-gb,en,eo,es,et,eu,fa,fi,fo,fr-ca,fr,gl,gu,he,hi,hr,hu,is,it,ja,ka,km,ko,ku,lt,lv,mk,mn,ms,nb,nl,no,pl,pt-br,pt,ro,ru,sk,sl,sr-latn,sr,sv,th,tr,ug,uk,vi,zh-cn,zh', // %REMOVE_LINE_CORE%
		icons: 'horizontalrule', // %REMOVE_LINE_CORE%
		init: function( editor ) {
			if ( editor.blockless )
				return;

			editor.addCommand( pluginName, horizontalruleCmd );
			editor.ui.addButton && editor.ui.addButton( 'HorizontalRule', {
				label: editor.lang.horizontalrule.toolbar,
				command: pluginName,
				toolbar: 'insert,40'
			});
		}
	});
})();
