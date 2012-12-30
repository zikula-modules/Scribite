<!-- start Scribite with TinyMCE for {$Scribite.modname} -->
{pageaddvar name="javascript" value="modules/Scribite/plugins/TinyMCE/vendor/tiny_mce/tiny_mce.js"}
<script type="text/javascript">
/* <![CDATA[ */
    var scribite_init = function () {
        var textareaList = document.getElementsByTagName('textarea');
        var assignedTextareasList = '';
        for(i = 0; i < textareaList.length; i++) {
            // check to make sure textarea not in disabled list or has 'noeditor' class
            // this editor does not use jQuery or prototype so reverting to manual JS - this may not work...
            if ((disabledTextareas.indexOf(textareaList[i].id) == -1) && !(textareaList[i].class == 'noeditor')) {
                // attach the editor
                assignedTextareasList += textareaList[i].id + ",";
                // notify subscriber
                insertNotifyInput(textareaList[i].id);
            }
        }
        assignedTextareasList = assignedTextareasList.substr(0, assignedTextareasList.length-1);
        tinyMCE.init({
            mode : "exact",
            elements: assignedTextareasList,
            theme : "{{$Scribite.editorVars.theme}}",
            language : "{{$Scribite.editorVars.language}}",
    {{if isset($Scribite.editorVars.activeplugins) && $Scribite.editorVars.activeplugins != ''}}
            plugins : "{{','|implode:$Scribite.editorVars.activeplugins}}",
    {{/if}}
            content_css : "{{$baseurl}}{{$Scribite.editorVars.style}}",
            cleanup : true,

    {{if $Scribite.editorVars.theme eq "advanced"}}
            theme_advanced_toolbar_location : "top",
            theme_advanced_toolbar_align : "left",
            theme_advanced_statusbar_location : "bottom",
            theme_advanced_resizing : true,

            // Default buttons available in the advanced theme
            theme_advanced_buttons1 : "bold,italic,underline,strikethrough,justifyleft,justifycenter,justifyright,justifyfull,bullist,numlist,outdent,indent,cut,copy,paste,undo,redo,link,unlink,image,cleanup",
            theme_advanced_buttons2 : "code,anchor,fontselect,fontsizeselect,sub,sup,forecolor,backcolor,charmap,visualaid,blockquote,hr,removeformat,help",

            // Individual buttons configured in the module's settings
            theme_advanced_buttons3 : "{{$Scribite.editorParameters.buttons}}",

            // TODO: I really would like to split this into multiple row, but I do not know how
            //theme_advanced_buttons3 : "{{* foreach from=$Scribite.editorParameters.buttons item='tinymce_button' *}}{{* $timymce_button* }},{{* /foreach* }}",

            // Skin options
            skin : "o2k7",
            skin_variant : "silver",


            plugin_insertdate_dateFormat : "{{$Scribite.editorVars.dateformat}}",
            plugin_insertdate_timeFormat : "{{$Scribite.editorVars.timeformat}}",

            paste_auto_cleanup_on_paste : true,
            paste_convert_middot_lists : true,
            paste_strip_class_attributes : "all",
            paste_remove_spans : false,
            paste_remove_styles_if_webkit : true,
    {{/if}}

            valid_elements : "*[*]",
    {{if isset($Scribite.disallowedhtml)}}invalid_elements : "{{','|implode:$Scribite.disallowedhtml}}",{{/if}}
            height : "{{$Scribite.editorVars.height}}",
            width : "{{$Scribite.editorVars.width}}",
    {{if $modvars.Scribite.image_upload}}        
            file_browser_callback: "filebrowser",
            convert_urls : false
    {{/if}}


        });
    }

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

if (window.addEventListener) { // modern browsers
    window.addEventListener('load' , scribite_init, false);
} else if (window.attachEvent) { // ie8 and even older browsers
    window.attachEvent('onload', scribite_init);
} else { // fallback, not truly necessary
    window.onload = scribite_init;
}

/* ]]> */
</script>
<!-- End Scribite with TinyMCE for {$Scribite.modname} -->