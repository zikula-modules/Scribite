<!-- start Scribite with Markitup for {$modname} -->
{pageaddvar name="javascript" value="jquery"}
{pageaddvar name="stylesheet" value="modules/Scribite/Plugins/MarkItUp/style/style.css"}
{pageaddvar name="javascript" value="modules/Scribite/lib/Scribite/Editor/MarkItUp/markitup/jquery.markitup.js"}
{pageaddvar name="javascript" value="modules/Scribite/lib/Scribite/Editor/MarkItUp/markitup/sets/default/set.js"}
{pageaddvar name="stylesheet" value="modules/Scribite/lib/Scribite/Editor/MarkItUp/markitup/sets/default/style.css"}
{pageaddvar name="stylesheet" value="modules/Scribite/lib/Scribite/Editor/MarkItUp/markitup/skins/markitup/style.css"}

<script type="text/javascript">
<!--
jQuery(document).ready(function()	{
jQuery('textarea').css('width','{{if $markitup_width eq "auto"}}auto{{else}}{{$markitup_width}}{{/if}}').css('height','{{if $markitup_height eq "auto"}}auto{{else}}{{$markitup_height}}{{/if}}').markItUp(mySettings);	
});
-->
</script>
<!-- end Scribite with Markitup -->