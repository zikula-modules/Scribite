<!-- start Scribite with Markitup for {$modname} -->
{pageaddvar name="javascript" value="jquery"}
{pageaddvar name="stylesheet" value="modules/Scribite/plugins/MarkItUp/style/style.css"}
{pageaddvar name="javascript" value="modules/Scribite/plugins/MarkItUp/javascript/markitup/jquery.markitup.js"}
{pageaddvar name="javascript" value="modules/Scribite/plugins/MarkItUp/javascript/markitup/sets/default/set.js"}
{pageaddvar name="stylesheet" value="modules/Scribite/plugins/MarkItUp/javascript/markitup/sets/default/style.css"}
{pageaddvar name="stylesheet" value="modules/Scribite/plugins/MarkItUp/javascript/markitup/skins/markitup/style.css"}

<script type="text/javascript">
<!--
jQuery(document).ready(function()	{
jQuery('textarea').css('width','{{if $width eq "auto"}}auto{{else}}{{$width}}{{/if}}').css('height','{{if $height eq "auto"}}auto{{else}}{{$height}}{{/if}}').markItUp(mySettings);
});
-->
</script>
<!-- end Scribite with Markitup -->