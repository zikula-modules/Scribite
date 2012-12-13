<!-- start Scribite with TinyMCE for {$modname} -->
{pageaddvar name="javascript" value="modules/Scribite/plugins/TinyMCE/vendor/tiny_mce/tiny_mce.js"}
<script type="text/javascript">
/* <![CDATA[ */

   tinyMCE.init({
        mode : "textareas",
        theme : "{{$theme}}",
        language : "{{$language}}",
{{if isset($activeplugins) && $activeplugins != ''}}
        plugins : "{{','|implode:$activeplugins}}",
{{/if}}
        content_css : "{{$zBaseUrl}}/{{$style}}",
        cleanup : true,

{{if $theme eq "advanced"}}
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,

        // Default buttons available in the advanced theme
        theme_advanced_buttons1 : "bold,italic,underline,strikethrough,justifyleft,justifycenter,justifyright,justifyfull,bullist,numlist,outdent,indent,cut,copy,paste,undo,redo,link,unlink,image,cleanup",
        theme_advanced_buttons2 : "code,anchor,fontselect,fontsizeselect,sub,sup,forecolor,backcolor,charmap,visualaid,blockquote,hr,removeformat,help",

        // Individual buttons configured in the module's settings
        theme_advanced_buttons3 : "{{$buttons}}",
        
        // TODO: I really would like to split this into multiple row, but I do not know how
        //theme_advanced_buttons3 : "{{* foreach from=$buttons key=k item=tinymce_button *}}{{* $button* }},{{* /foreach* }}",

        // Skin options
        skin : "o2k7",
        skin_variant : "silver",
        

        plugin_insertdate_dateFormat : "{{$dateformat}}",
        plugin_insertdate_timeFormat : "{{$timeformat}}",

        paste_auto_cleanup_on_paste : true,
        paste_convert_middot_lists : true,
        paste_strip_class_attributes : "all",
        paste_remove_spans : false,
        paste_remove_styles_if_webkit : true,
{{/if}}

        valid_elements : "*[*]",
{{if isset($disallowedhtml)}}invalid_elements : "{{','|implode:$disallowedhtml}}",{{/if}}
        height : "{{$height}}",
        width : "{{$width}}",
{{if $modvars.Scribite.image_upload}}        
        file_browser_callback: "filebrowser",
        convert_urls : false
{{/if}}
        
        
    });

{{if $modvars.Scribite.image_upload}}
	function filebrowser(field_name, url, type, win) {
			window.SetUrl = function(fileUrl){
				win.document.forms[0].elements[field_name].value = fileUrl;
			}
			var type = type.toLowerCase();
			var filebrowser = Zikula.Config.baseURL+"index.php?module=Scribite&type=user&func=browseImages&editor=tinymc";
			tinyMCE.activeEditor.windowManager.open({
				file : filebrowser,
				width : 600,
				height : 400,
				resizable : "yes",
				close_previous : "no"
			});
			return false;
	}
{{/if}}

/* ]]> */
</script>
<!-- End Scribite with TinyMCE for {$modname} -->