<!-- start scribite! with nicEditor for {$modname} -->
{pageaddvar name="stylesheet" value="modules/Scribite/includes/markitup/style.css"}
{pageaddvar name="stylesheet" value="modules/Scribite/includes/markitup/skins/markitup/style.css"}
{pageaddvar name="stylesheet" value="modules/Scribite/style/markitup/style.css"}

<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.2.min.js"></script>

<script type="text/javascript" src="modules/Scribite/includes/markitup/set.js"></script>

<script type="text/javascript" src="modules/Scribite/includes/markitup/jquery.markitup.js"></script>



<script type="text/javascript">
<!--
jQuery.noConflict();
jQuery(document).ready(function()	{
jQuery('textarea').css('width','{{if $markitup_width eq "auto"}}auto{{else}}{{$markitup_width}}px{{/if}}').css('height','{{if $markitup_height eq "auto"}}auto{{else}}{{$markitup_height}}px{{/if}}').markItUp(mySettings);
	
	// You can add content from anywhere in your page
	// $.markItUp( { Settings } );	
	jQuery('.add').click(function() {
 		jQuery.markItUp( { 	openWith:'<opening tag>',
						closeWith:'<\/closing tag>',
						placeHolder:"New content"
					}
				);
 		return false;
	});
	
	// And you can add/remove markItUp! whenever you want
	// $(textarea).markItUpRemove();
	jQuery('.toggle').click(function() {
		if (jQuery("#markItUp.markItUpEditor").length === 1) {
 			jQuery("#markItUp").markItUpRemove();
			jQuery("span", this).text("get markItUp! back");
		} else {
			jQuery('#markItUp').markItUp(mySettings);
			jQuery("span", this).text("remove markItUp!");
		}
 		return false;
	});
});
-->
</script>


