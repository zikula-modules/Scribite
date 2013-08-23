<!-- start Scribite with TinyMCE for {$Scribite.modname} -->
{pageaddvar name="javascript" value="modules/Scribite/plugins/TinyMce/vendor/tiny_mce/tiny_mce.js"}
{pageaddvar name="javascript" value="modules/Scribite/plugins/TinyMce/javascript/TinyMce.ajaxApi.js"}
<script type="text/javascript">
/* <![CDATA[ */

    // constuct param object for default config of tinymce
    var tinymceParams = {
        mode : "exact",
        // elements are assigned below before init
        theme : "{{$Scribite.editorVars.theme}}",
        language : "{{$Scribite.editorVars.language}}",
{{if isset($Scribite.editorVars.activeplugins) && $Scribite.editorVars.activeplugins != ''}}
        plugins : "{{','|implode:$Scribite.editorVars.activeplugins}}{{if !empty($Scribite.addExtEdPlugins)}}{{foreach from=$Scribite.addExtEdPlugins item='ePlugin'}},-{{$ePlugin.name}}{{/foreach}}{{/if}}",
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
        theme_advanced_buttons3 : "{{if !empty($Scribite.editorParameters.buttons)}}{{$Scribite.editorParameters.buttons}}{{/if}}{{if !empty($Scribite.addExtEdPlugins)}}{{foreach from=$Scribite.addExtEdPlugins item='ePlugin'}},{{$ePlugin.name}}{{/foreach}}{{/if}}",

        // TODO: I really would like to split this into multiple row, but I do not know how
        //theme_advanced_buttons3 : "{{* foreach from=$Scribite.editorParameters.buttons item='tinymce_button' *}}{{* $timymce_button *}},{{* /foreach *}}",

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
    }
    
    var textareaClassnames = {};
    var scribite_init = function () {
        var textareaList = document.getElementsByTagName('textarea');
    {{if $Scribite.paramOverrides}}
        // configure and init each textarea
        for(i = 0; i < textareaList.length; i++) {
            // check to make sure textarea not in disabled list or has 'noeditor' class
            // this editor does not use jQuery or prototype so reverting to manual JS
            if ((disabledTextareas.indexOf(textareaList[i].id) == -1) && !(textareaList[i].className.split(' ').indexOf('noeditor') > -1)) {
                // generate and add a classname to the textarea and store in object
                textareaClassnames[textareaList[i].id] = Scribite.generateString(5);
                tinyMCE.DOM.addClass(textareaList[i].id, textareaClassnames[textareaList[i].id]);
                var oParams = new Object();
                tinyMCE.extend(oParams, tinymceParams);
                var paramOverrideObj = window["paramOverrides_" + textareaList[i].id];
                if (typeof paramOverrideObj != "undefined") {
                    // override existing values in the `params` obj
                    tinyMCE.extend(oParams, paramOverrideObj);
                }
                if (typeof paramOverrides_all != "undefined") {
                    // override existing values in if 'all' is set as textarea for override
                    // overrides individual textarea overrides!
                    tinyMCE.extend(oParams, paramOverrides_all);
                }
                oParams.mode = 'textareas';
                oParams.editor_selector = textareaClassnames[textareaList[i].id];
                tinyMCE.init(oParams);
                // notify subscriber
                insertNotifyInput(textareaList[i].id);
            }
        }
    {{else}}
        // make a list of all textareas except those disabled or excluded and init all of them.
        var assignedTextareasList = '';
        for(i = 0; i < textareaList.length; i++) {
            // check to make sure textarea not in disabled list or has 'noeditor' class
            // this editor does not use jQuery or prototype so reverting to manual JS
            if ((disabledTextareas.indexOf(textareaList[i].id) == -1) && !(textareaList[i].className.split(' ').indexOf('noeditor') > -1)) {
                // add textarea to element list
                assignedTextareasList += textareaList[i].id + ",";
                // notify subscriber
                insertNotifyInput(textareaList[i].id);
            }
        }
        // add element list to param object (remove trailing comma)
        tinymceParams.elements = assignedTextareasList.substr(0, assignedTextareasList.length-1);
        tinyMCE.init(tinymceParams);
    {{/if}}
    // load external plugins if available
    {{if !empty($Scribite.addExtEdPlugins)}}
    {{foreach from=$Scribite.addExtEdPlugins item='ePlugin'}}
        tinyMCE.PluginManager.load('{{$ePlugin.name}}', Zikula.Config.baseURL+'{{$ePlugin.path}}');
    {{/foreach}}
    {{/if}}
    }
    // instantiate CKEditor's Scribite object for editor creation and ajax manipulation
    Scribite = new ScribiteUtil();

if (window.addEventListener) { // modern browsers
    window.addEventListener('load' , Scribite.createEditors, false);
} else if (window.attachEvent) { // ie8 and even older browsers
    window.attachEvent('onload', Scribite.createEditors);
} else { // fallback, not truly necessary
    window.onload = Scribite.createEditors;
}
/* ]]> */
</script>
<!-- End Scribite with TinyMCE for {$Scribite.modname} -->