/**
 * @license Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

/**
 * @fileOverview Horizontal Page Break
 */

// Register a plugin named "zikulapagebreak".
CKEDITOR.plugins.add( 'zikulapagebreak', {
	requires: 'fakeobjects',
	lang: 'en,de,nl',
	icons: 'zikulapagebreak,zikulapagebreak-rtl',
	onLoad: function() {
		var cssStyles = [
			'{',
				'background: url(' + CKEDITOR.getUrl( this.path + 'images/zikulapagebreak.gif' ) + ') no-repeat center center;',
				'clear: both;',
				'width:100%; _width:99.9%;',
				'border-top: #999999 1px dotted;',
				'border-bottom: #999999 1px dotted;',
				'padding:0;',
				'height: 5px;',
				'cursor: default;',
			'}'
			].join( '' ).replace( /;/g, ' !important;' ); // Increase specificity to override other styles, e.g. block outline.

		// Add the style that renders our placeholder.
		CKEDITOR.addCss( 'div.cke_pagebreak' + cssStyles );
	},
	init: function( editor ) {
		if ( editor.blockless )
			return;

		// Register the command.
		editor.addCommand( 'zikulapagebreak', CKEDITOR.plugins.zikulapagebreakCmd );

		// Register the toolbar button.
		editor.ui.addButton && editor.ui.addButton( 'ZikulaPageBreak', {
			label: editor.lang.zikulapagebreak.toolbar,
			command: 'zikulapagebreak',
			toolbar: 'insert,70'
		});

		// Opera needs help to select the page-break.
		CKEDITOR.env.opera && editor.on( 'contentDom', function() {
			editor.document.on( 'click', function( evt ) {
				var target = evt.data.getTarget();
				if ( target.is( 'div' ) && target.hasClass( 'cke_pagebreak' ) )
					editor.getSelection().selectElement( target );
			});
		});
	},

	afterInit: function( editor ) {
		var label = editor.lang.zikulapagebreak.alt;

		// Register a filter to displaying placeholders after mode change.
		var dataProcessor = editor.dataProcessor,
			dataFilter = dataProcessor && dataProcessor.dataFilter,
			htmlFilter = dataProcessor && dataProcessor.htmlFilter;

		if ( htmlFilter ) {
			htmlFilter.addRules({
				attributes: {
					'class': function( value, element ) {
						var className = value.replace( 'cke_pagebreak', '' );
						if ( className != value ) {
							var span = CKEDITOR.htmlParser.fragment.fromHtml( '<span style="display: none;">&nbsp;</span>' );
							element.children.length = 0;
							element.add( span );
							var attrs = element.attributes;
							delete attrs[ 'aria-label' ];
							delete attrs.contenteditable;
							delete attrs.title;
						}
						return className;
					}
				}
			}, 5 );
		}

		if ( dataFilter ) {
			dataFilter.addRules({
				elements: {
					div: function( element ) {
						var attributes = element.attributes,
							style = attributes && attributes.style,
							child = style && element.children.length == 1 && element.children[ 0 ],
							childStyle = child && ( child.name == 'span' ) && child.attributes.style;

						if ( childStyle && ( /page-break-after\s*:\s*always/i ).test( style ) && ( /display\s*:\s*none/i ).test( childStyle ) ) {
							attributes.contenteditable = "false";
							attributes[ 'class' ] = "cke_pagebreak";
							attributes[ 'data-cke-display-name' ] = "pagebreak";
							attributes[ 'aria-label' ] = label;
							attributes[ 'title' ] = label;

							element.children.length = 0;
						}
					}
				}
			});
		}
	}
});

// TODO Much probably there's no need to expose this object as public object.

CKEDITOR.plugins.zikulapagebreakCmd = {
	exec: function( editor ) {
		var label = editor.lang.zikulapagebreak.alt;

		// Create read-only element that represents a print break.
		var pagebreak = CKEDITOR.dom.element.createFromHtml( '<div style="' +
			'page-break-after: always;"' +
			'contenteditable="false" ' +
			'title="' + label + '" ' +
			'aria-label="' + label + '" ' +
			'data-cke-display-name="pagebreak" ' +
			'class="cke_pagebreak">' +
			'</div>', editor.document );
		editor.insertElement( pagebreak );
	},
	context: 'div'
};
