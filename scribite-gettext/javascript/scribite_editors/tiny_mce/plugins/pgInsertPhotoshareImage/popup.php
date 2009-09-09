<?php
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>{$lang_pgInsertPhotoshareImage_title}</title>
	<script language="javascript" type="text/javascript" src="../../tiny_mce_src.js"></script>
	<script language="javascript" type="text/javascript" src="../../tiny_mce_popup.js"></script>
	<script language="javascript" type="text/javascript" src="../../utils/mctabs.js"></script>
	<script language="javascript" type="text/javascript" src="../../utils/form_utils.js"></script>
	<script language="javascript" type="text/javascript" src="scripts/pgInsertPhotoshareImage.js"></script>
	<script language="javascript" type="text/javascript" src="scripts/showimage.js"></script>
	<link href="../../themes/advanced/css/editor_popup.css" rel="stylesheet" type="text/css" />
</head>
<body onLoad="handleOnLoad()">
	<form onsubmit="insert(); return false;" name="pgInsertPhotoshareImageForm" id="pgInsertPhotoshareImageForm" action="#">
		<input type="hidden" id="imageId" name="imageId" value=""/>
  
		<h3>{$lang_pgInsertPhotoshareImage_title}</h3>

		<!-- Gets filled with the selected elements name -->
		<div style="margin-top: 10px; margin-bottom: 10px">
<?php
		// TODO use something more relable here then $_SERVER['HTTP_HOST']
		require_once("http://".$_SERVER['HTTP_HOST']."/index.php?module=photoshare&func=mce_findimage");
?>
		</div>

		<div class="mceActionPanel">
			<div style="float: left">
				<input type="button" id="insert" name="insert" value="{$lang_insert}" onclick="insertPhotoshareImage();" />
			</div>

			<div style="float: right">
				<input type="button" id="cancel" name="cancel" value="{$lang_cancel}" onclick="tinyMCEPopup.close();" />
			</div>
		</div>
	</form>
</body> 
</html> 
<?php
?>