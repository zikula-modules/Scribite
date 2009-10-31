<?php
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>{$lang_pgInsertPublicationLink_title}</title>
	<script language="javascript" type="text/javascript" src="../../tiny_mce_popup.js"></script>
	<script language="javascript" type="text/javascript" src="../../utils/mctabs.js"></script>
	<script language="javascript" type="text/javascript" src="../../utils/form_utils.js"></script>
	<script language="javascript" type="text/javascript" src="jscripts/pgInsertPublicationLink.js"></script>
	<link href="../../themes/advanced/css/editor_popup.css" rel="stylesheet" type="text/css" />
</head>
<body onload=" pubtypes_change(document.getElementById('pgInsertPublicationLinkForm'), allpubtypes, allpublications);" >
	<form onsubmit="insert(); return false;" name="pgInsertPublicationLinkForm" id="pgInsertPublicationLinkForm" action="#">
		<h3>{$lang_pgInsertPublicationLink_title}</h3>

		<!-- Gets filled with the selected elements name -->
		<div style="margin-top: 10px; margin-bottom: 10px">
<?php
		// TODO use something more relable here then $_SERVER['HTTP_HOST']
		require_once("http://".$_SERVER['HTTP_HOST']."/pn8rc3/index.php?module=pagesetter&func=pubselect");
?>
		</div>

		<div class="mceActionPanel">
			<div style="float: left">
				<input type="button" id="insert" name="insert" value="{$lang_insert}" onclick="insertPublicationLink(document.getElementById('pgInsertPublicationLinkForm'), allpublications);" />
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
