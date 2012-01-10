/**
 * @fileOverview The "zikulapagebreak" plugin.
 *
 */

(function()
{
	CKEDITOR.plugins.add( 'zikulapagebreak',
	{
		requires : [ 'dialog' ],
		lang : [ 'en', 'de' ],
		init : function( editor )
		{
			var lang = editor.lang.zikulapagebreak;

			editor.ui.addButton( 'ZikulaPagebreak',
			{
				label : lang.toolbar,
				command :'insertzikulapagebreak',
				icon : this.path + 'zikulapagebreak.png'
			});

    		editor.addCommand( 'insertzikulapagebreak',
    			{
    				exec : function( editor )
    				{    
    					editor.insertHtml( '<div class=\"pagebreak\"><\/div><!--pagebreak-->' );
    				}
    			});

    		var cssStyles = [
    			'{' ,
    				'background: url(' + CKEDITOR.getUrl( this.path + 'images/pagebreak.gif' ) + ') no-repeat center center;' ,
    				'clear: both;' ,
    				'width:100%; _width:99.9%;' ,
    				'border-top: #999999 1px dotted;' ,
    				'border-bottom: #999999 1px dotted;' ,
    				'padding:0;' ,
    				'height: 5px;' ,
    				'cursor: default;' ,
    			'}'
    			].join( '' ).replace(/;/g, ' !important;' );

    		editor.addCss( 'div.pagebreak' + cssStyles );

			editor.on( 'contentDom', function()
				{
					editor.document.getBody().on( 'resizestart', function( evt )
						{
							if ( editor.getSelection().getSelectedElement().data( 'pagebreak' ) )
								evt.data.preventDefault();
						});
				});

		}
	});
})();
