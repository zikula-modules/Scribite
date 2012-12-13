<!-- start Scribite with Markitup for {$Scribite.modname} -->
{pageaddvar name="javascript" value="jquery"}
{pageaddvar name="stylesheet" value="modules/Scribite/plugins/MarkItUp/style/style.css"}
{pageaddvar name="javascript" value="modules/Scribite/plugins/MarkItUp/vendor/markitup/jquery.markitup.js"}
{pageaddvar name="javascript" value="modules/Scribite/plugins/MarkItUp/vendor/markitup/sets/default/set.js"}
{pageaddvar name="stylesheet" value="modules/Scribite/plugins/MarkItUp/vendor/markitup/sets/default/style.css"}
{pageaddvar name="stylesheet" value="modules/Scribite/plugins/MarkItUp/vendor/markitup/skins/markitup/style.css"}

<script type="text/javascript">
<!--
jQuery(document).ready(function()	{
jQuery('textarea').css('width','{{if $Scribite.editorVars.width eq "auto"}}auto{{else}}{{$Scribite.editorVars.width}}{{/if}}').css('height','{{if $Scribite.editorVars.height eq "auto"}}auto{{else}}{{$Scribite.editorVars.height}}{{/if}}').markItUp(mySettings);	
});
-->
</script>
<!-- end Scribite with Markitup -->