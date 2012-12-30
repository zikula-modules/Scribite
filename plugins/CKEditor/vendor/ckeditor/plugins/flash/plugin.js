﻿/**
 * @license Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

(function() {
	var flashFilenameRegex = /\.swf(?:$|\?)/i;

	function isFlashEmbed( element ) {
		var attributes = element.attributes;

		return ( attributes.type == 'application/x-shockwave-flash' || flashFilenameRegex.test( attributes.src || '' ) );
	}

	function createFakeElement( editor, realElement ) {
		return editor.createFakeParserElement( realElement, 'cke_flash', 'flash', true );
	}

	CKEDITOR.plugins.add( 'flash', {
		requires: 'dialog,fakeobjects',
		lang: 'af,ar,bg,bn,bs,ca,cs,cy,da,de,el,en-au,en-ca,en-gb,en,eo,es,et,eu,fa,fi,fo,fr-ca,fr,gl,gu,he,hi,hr,hu,is,it,ja,ka,km,ko,ku,lt,lv,mk,mn,ms,nb,nl,no,pl,pt-br,pt,ro,ru,sk,sl,sr-latn,sr,sv,th,tr,ug,uk,vi,zh-cn,zh', // %REMOVE_LINE_CORE%
		icons: 'flash', // %REMOVE_LINE_CORE%
		onLoad: function() {
			CKEDITOR.addCss( 'img.cke_flash' +
				'{' +
					'background-image: url(' + CKEDITOR.getUrl( this.path + 'images/placeholder.png' ) + ');' +
					'background-position: center center;' +
					'background-repeat: no-repeat;' +
					'border: 1px solid #a9a9a9;' +
					'width: 80px;' +
					'height: 80px;' +
				'}'
				);

		},
		init: function( editor ) {
			editor.addCommand( 'flash', new CKEDITOR.dialogCommand( 'flash' ) );
			editor.ui.addButton && editor.ui.addButton( 'Flash', {
				label: editor.lang.common.flash,
				command: 'flash',
				toolbar: 'insert,20'
			});
			CKEDITOR.dialog.add( 'flash', this.path + 'dialogs/flash.js' );

			// If the "menu" plugin is loaded, register the menu items.
			if ( editor.addMenuItems ) {
				editor.addMenuItems({
					flash: {
						label: editor.lang.flash.properties,
						command: 'flash',
						group: 'flash'
					}
				});
			}

			editor.on( 'doubleclick', function( evt ) {
				var element = evt.data.element;

				if ( element.is( 'img' ) && element.data( 'cke-real-element-type' ) == 'flash' )
					evt.data.dialog = 'flash';
			});

			// If the "contextmenu" plugin is loaded, register the listeners.
			if ( editor.contextMenu ) {
				editor.contextMenu.addListener( function( element, selection ) {
					if ( element && element.is( 'img' ) && !element.isReadOnly() && element.data( 'cke-real-element-type' ) == 'flash' )
						return { flash: CKEDITOR.TRISTATE_OFF };
				});
			}
		},

		afterInit: function( editor ) {
			var dataProcessor = editor.dataProcessor,
				dataFilter = dataProcessor && dataProcessor.dataFilter;

			if ( dataFilter ) {
				dataFilter.addRules({
					elements: {
						'cke:object': function( element ) {
							var attributes = element.attributes,
								classId = attributes.classid && String( attributes.classid ).toLowerCase();

							if ( !classId && !isFlashEmbed( element ) ) {
								// Look for the inner <embed>
								for ( var i = 0; i < element.children.length; i++ ) {
									if ( element.children[ i ].name == 'cke:embed' ) {
										if ( !isFlashEmbed( element.children[ i ] ) )
											return null;

										return createFakeElement( editor, element );
									}
								}
								return null;
							}

							return createFakeElement( editor, element );
						},

						'cke:embed': function( element ) {
							if ( !isFlashEmbed( element ) )
								return null;

							return createFakeElement( editor, element );
						}
					}
				}, 5 );
			}
		}
	});
})();

CKEDITOR.tools.extend( CKEDITOR.config, {
	/**
	 * Save as `<embed>` tag only. This tag is unrecommended.
	 *
	 * @cfg {Boolean} [flashEmbedTagOnly=false]
	 * @member CKEDITOR.config
	 */
	flashEmbedTagOnly: false,

	/**
	 * Add `<embed>` tag as alternative: `<object><embed></embed></object>`.
	 *
	 * @cfg {Boolean} [flashAddEmbedTag=false]
	 * @member CKEDITOR.config
	 */
	flashAddEmbedTag: true,

	/**
	 * Use {@link #flashEmbedTagOnly} and {@link #flashAddEmbedTag} values on edit.
	 *
	 * @cfg {Boolean} [flashConvertOnEdit=false]
	 * @member CKEDITOR.config
	 */
	flashConvertOnEdit: false
});
