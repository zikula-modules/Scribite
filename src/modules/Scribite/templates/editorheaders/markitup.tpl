<!-- start scribite! with Markitup for {$modname} -->
{pageaddvar name="javascript" value="jquery"}
{pageaddvar name="javascript" value="modules/Scribite/includes/markitup/jquery.markitup.js"}
{pageaddvar name="javascript" value="modules/Scribite/includes/markitup/sets/default/set.js"}
{pageaddvar name="stylesheet" value="modules/Scribite/includes/markitup/sets/default/style.css"}
{pageaddvar name="stylesheet" value="modules/Scribite/includes/markitup/skins/markitup/style.css"}

<script type="text/javascript">
<!--
jQuery(document).ready(function()	{
jQuery('textarea').css('width','{{if $markitup_width eq "auto"}}auto{{else}}{{$markitup_width}}px{{/if}}').css('height','{{if $markitup_height eq "auto"}}auto{{else}}{{$markitup_height}}px{{/if}}').markItUp(mySettings);	
});
-->
</script>