<script type="text/javascript" src="modules/Scribite/includes/tinymce/tiny_mce.js"></script>
<script type="text/javascript">
/* <![CDATA[ */

   tinyMCE.init({
        mode : "textareas",
        theme : "{{$tinymce_theme}}",
        language : "{{$tinymce_language}}",
        {{if isset($tinymce_listplugins)}}
        plugins : "{{$tinymce_listplugins}}",
        {{/if}}
        content_css : "{{$zBaseUrl}}/{{$tinymce_style}}",
        cleanup : true,

{{if $tinymce_theme eq "advanced"}}
       theme_advanced_toolbar_location : "top",
       theme_advanced_toolbar_align : "left",
       theme_advanced_statusbar_location : "bottom",
       theme_advanced_buttons1_add_before : "template,xhtmlxtras,devkit,separator",
       theme_advanced_buttons1_add : "fontsizeselect,forecolor,backcolor,directionality",
       theme_advanced_buttons1_add : "fontselect",
       theme_advanced_buttons2_add : "separator,visualchars,insertdate,inserttime,preview,zoom,bbcode",
       theme_advanced_buttons2_add_before: "cut,copy,paste,pastetext,pasteword,separator,search,replace,separator",
       theme_advanced_buttons3_add_before : "tablecontrols,separator",
       theme_advanced_buttons3_add : "pgInsertPhotoshareImage,pgInsertPublicationLink,emotions,iespell,layer,flash,media,advhr,separator,print,separator,ltr,rtl,separator,fullscreen",

        plugin_insertdate_dateFormat : "{{$tinymce_dateformat}}",
        plugin_insertdate_timeFormat : "{{$tinymce_timeformat}}",

        paste_auto_cleanup_on_paste : true,
        paste_convert_middot_lists : true,
        paste_strip_class_attributes : "all",
        paste_remove_spans : false,
        paste_remove_styles_if_webkit : true,
{{/if}}

        valid_elements : "*[*]",
        {{if isset($disallowedhtml)}}	
        invalid_elements : "{{$disallowedhtml}}",
        {{/if}}
        height : "{{$tinymce_height}}",
        width : "{{$tinymce_width}}"
    });

/* ]]> */
</script>