/*
help: http://docs.cksource.com/ckeditor_api/symbols/CKEDITOR.config.html
*/

CKEDITOR.editorConfig = function( config )
{
	config.uiColor = '#D3D3D3';
	config.enterMode = CKEDITOR.ENTER_BR;
	config.shiftEnterMode = CKEDITOR.ENTER_P;
	config.disableNativeSpellChecker = false;
	//config.extraPlugins = 'autogrow'; loaded in Scribite interface
	config.toolbar_adminbar =
	[
		{ name: 'document',    items : [ 'Maximize','Source','ShowBlocks','DocProps','Preview' ] },
		{ name: 'clipboard',   items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','RemoveFormat','Undo','Redo' ] },
		{ name: 'editing',     items : [ 'Find','Replace','SelectAll','SpellChecker', 'Scayt' ] },
		{ name: 'links',       items : [ 'Link','Unlink','Anchor' ] },
		{ name: 'insert',      items : [ 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak' ] },
		'/',
		{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript' ] },
		{ name: 'paragraph',   items : [ 'NumberedList','BulletedList','Outdent','Indent','Blockquote','CreateDiv','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock' ] },
		{ name: 'styles',      items : [ 'Styles','Format','Font','FontSize' ] },
		{ name: 'colors',      items : [ 'TextColor','BGColor' ] }
	];
	config.toolbar_userbar1 =
	[
		{ name: 'document',    items : [ 'Maximize','Source','ShowBlocks','Preview' ] },
		{ name: 'clipboard',   items : [ 'Cut','Copy','PasteText','PasteFromWord','RemoveFormat','Undo','Redo' ] },
		{ name: 'editing',     items : [ 'Find','Replace' ] },
		{ name: 'links',       items : [ 'Link','Unlink','Anchor' ] },
		{ name: 'insert',      items : [ 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar' ] },
		'/',
		{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript' ] },
		{ name: 'paragraph',   items : [ 'NumberedList','BulletedList','Outdent','Indent','Blockquote','CreateDiv','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock' ] },
		{ name: 'styles',      items : [ 'Styles','Format','Font','FontSize' ] },
		{ name: 'colors',      items : [ 'TextColor','BGColor' ] }
	];
	config.toolbar_userbar2 =
	[
		{ name: 'document',    items : [ 'Maximize','Source','Cut','Copy','PasteText','PasteFromWord','RemoveFormat','Link' ] },
		{ name: 'insert',      items : [ 'Image','Table','Smiley','SpecialChar' ] },
		{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript' ] },
		{ name: 'paragraph',   items : [ 'JustifyLeft','JustifyCenter','JustifyRight' ] },
		{ name: 'colors',      items : [ 'TextColor','BGColor' ] }
	];
	/* config.filebrowserBrowseUrl = '/javascript/ckfinder/ckfinder.html';
	config.filebrowserImageBrowseUrl = '/javascript/ckfinder/ckfinder.html?Type=Images';
	config.filebrowserFilesBrowseUrl = '/javascript/ckfinder/ckfinder.html?Type=Files';
	config.filebrowserFlashBrowseUrl = '/javascript/ckfinder/ckfinder.html?Type=Flash';
	config.filebrowserUploadUrl = '/javascript/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
	config.filebrowserImageUploadUrl = '/javascript/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
	config.filebrowserFilesUploadUrl = '/javascript/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
	config.filebrowserFlashUploadUrl = '/javascript/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'; */
	
	/*config.filebrowserBrowseUrl = '/javascript/kcfinder/browse.php?type=files';
	config.filebrowserImageBrowseUrl = '/javascript/kcfinder/browse.php?type=images';
	config.filebrowserFilesBrowseUrl = '/javascript/kcfinder/browse.php?type=files';
	config.filebrowserFlashBrowseUrl = '/javascript/kcfinder/browse.php?type=flash';*/
	config.filebrowserUploadUrl = '/javascript/kcfinder/upload.php?type=files';
	config.filebrowserImageUploadUrl = '/javascript/kcfinder/upload.php?type=images';
	config.filebrowserFilesUploadUrl = '/javascript/kcfinder/upload.php?type=files';
	config.filebrowserFlashUploadUrl = '/javascript/kcfinder/upload.php?type=flash';
};
