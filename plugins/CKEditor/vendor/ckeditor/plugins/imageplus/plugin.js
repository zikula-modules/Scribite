/**
 * @license Copyright (c) 2018 Nikolay Petkow, www.cmstory.com
 * Based on Image plugin, CKSource - Frederico Knabben
 */

( function() {

	CKEDITOR.plugins.add( 'imageplus', {
		requires: 'dialog,contextmenu',
		lang: 'af,ar,az,bg,bn,bs,ca,cs,cy,da,de,de-ch,el,en,en-au,en-ca,en-gb,eo,es,es-mx,et,eu,fa,fi,fo,fr,fr-ca,gl,gu,he,hi,hr,hu,id,is,it,ja,ka,km,ko,ku,lt,lv,mk,mn,ms,nb,nl,no,oc,pl,pt,pt-br,ro,ru,si,sk,sl,sq,sr,sr-latn,sv,th,tr,tt,ug,uk,vi,zh,zh-cn',
		icons: CKEDITOR.config.imageplus.icon ? CKEDITOR.config.imageplus.icon : 'imageplus',
		hidpi: true,
		init: function( editor ) {
			var pluginName = 'imageplus';

			// Register the dialog.
			CKEDITOR.dialog.add( pluginName, this.path + 'dialogs/imageplus.js' );

			var allowed = 'img[alt,!src,width,height]{border-style,border-width,float,width,height,margin,margin-bottom,margin-left,margin-right,margin-top}',
				required = 'img[alt,src]';

			if ( CKEDITOR.dialog.isTabEnabled( editor, pluginName, 'advanced' ) )
				allowed = 'img[alt,dir,id,lang,longdesc,!src,title]{*}(*)';

			// Register the command.
			editor.addCommand( pluginName, new CKEDITOR.dialogCommand( pluginName, {
				allowedContent: allowed,
				requiredContent: required,
				contentTransformations: [
					//[ 'img{width}: sizeToStyle', 'img[width]: sizeToAttribute' ],
					[ 'img[width]: sizeToAttribute' ],
					[ 'img{float}: alignmentToStyle', 'img[align]: alignmentToAttribute' ]
				]
			} ) );

			// Register the toolbar button.
			editor.ui.addButton && editor.ui.addButton( 'Imageplus', {
				label: editor.lang.common.image + ' +',
                icon: CKEDITOR.config.imageplus.icon ? CKEDITOR.config.imageplus.icon : 'imageplus',
				command: pluginName,
				toolbar: 'image,2'
			} );

			// Register context menu option for editing widget.
			if ( editor.contextMenu ) {
				editor.addMenuGroup( 'image', 10 );

				editor.addMenuItem( 'imageplus', {
					label: editor.lang.imageplus.menu,
                    icon: CKEDITOR.config.imageplus.icon ? CKEDITOR.config.imageplus.icon : 'imageplus',
					command: 'imageplus',
					group: 'image',
                    order: 1
				} );

                // register the listeners.
				editor.contextMenu.addListener( function( element ) {
                        if ( getSelectedImage( editor, element ) ) {
                            return { imageplus: CKEDITOR.TRISTATE_ON };
                        }
                    } );
			}

		},
		afterInit: function( editor ) {
			// Customize the behavior of the alignment commands. (https://dev.ckeditor.com/ticket/7430)
			setupAlignCommand( 'left' );
			setupAlignCommand( 'right' );
			setupAlignCommand( 'center' );
			setupAlignCommand( 'block' );

			function setupAlignCommand( value ) {
				var command = editor.getCommand( 'justify' + value );
				if ( command ) {
					if ( value == 'left' || value == 'right' ) {
						command.on( 'exec', function( evt ) {
							var img = getSelectedImage( editor ),
								align;
							if ( img ) {
								align = getImageAlignment( img );
								if ( align == value ) {
									img.removeStyle( 'float' );

									// Remove "align" attribute when necessary.
									if ( value == getImageAlignment( img ) )
										img.removeAttribute( 'align' );
								} else {
									img.setStyle( 'float', value );
								}

								evt.cancel();
							}
						} );
					}

					command.on( 'refresh', function( evt ) {
						var img = getSelectedImage( editor ),
							align;
						if ( img ) {
							align = getImageAlignment( img );

							this.setState(
							( align == value ) ? CKEDITOR.TRISTATE_ON : ( value == 'right' || value == 'left' ) ? CKEDITOR.TRISTATE_OFF : CKEDITOR.TRISTATE_DISABLED );

							evt.cancel();
						}
					} );
				}
			}
		}
	} );

	function getSelectedImage( editor, element ) {
		if ( !element ) {
			var sel = editor.getSelection();
			element = sel.getSelectedElement();
		}

		if ( element && element.is( 'img' ) && !element.data( 'cke-realelement' ) && !element.isReadOnly() )
			return element;
	}

	function getImageAlignment( element ) {
		var align = element.getStyle( 'float' );

		if ( align == 'inherit' || align == 'none' )
			align = 0;

		if ( !align )
			align = element.getAttribute( 'align' );

		return align;
	}

} )();

/**
 * Determines whether dimension inputs should be automatically filled when the image URL changes in the Image plugin dialog window.
 *
 *		config.image_prefillDimensions = false;
 *
 * @since 4.5
 * @cfg {Boolean} [image_prefillDimensions=true]
 * @member CKEDITOR.config
 */

/**
 * Whether to remove links when emptying the link URL field in the Image dialog window.
 *
 *		config.image_removeLinkByEmptyURL = false;
 *
 * @cfg {Boolean} [image_removeLinkByEmptyURL=true]
 * @member CKEDITOR.config
 */
CKEDITOR.config.image_removeLinkByEmptyURL = true;

/**
 * Padding text to set off the image in the preview area.
 *
 *		config.image_previewText = CKEDITOR.tools.repeat( '___ ', 100 );
 *
 * @cfg {String} [image_previewText='Lorem ipsum dolor...' (placeholder text)]
 * @member CKEDITOR.config
 */
