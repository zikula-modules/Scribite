<!-- start Scribite with CKEditor for {$Scribite.modname} -->
{pageaddvar name="stylesheet" value="modules/Scribite/plugins/CKEditor/style/style.css"}
{pageaddvar name="javascript" value="modules/Scribite/plugins/CKEditor/vendor/ckeditor/ckeditor.js"}

{assign value=false var='useckfinder'}
{assign value=false var='usekcfinder'}

{if file_exists("`$Scribite.editorVars.filemanagerpath`/ckfinder.html")}
    {assign var="useckfinder" value=true}<script type="text/javascript" src="{$Scribite.editorVars.filemanagerpath}/ckfinder.js"></script>
{elseif file_exists("`$Scribite.editorVars.filemanagerpath`/browse.php")}
    {assign var="usekcfinder" value=true}
{/if}
{callfunc x_function='session_id' x_assign='session_id'}
<script type="text/javascript">
/* <![CDATA[ */
    {{if !empty($Scribite.addExtEdPlugins)}}
    {{foreach from=$Scribite.addExtEdPlugins item='ePlugin'}}
    CKEDITOR.plugins.addExternal('{{$ePlugin.name}}',Zikula.Config.baseURL+'{{$ePlugin.path}}','{{$ePlugin.file}}');
    {{/foreach}}
    {{/if}}

    var params = {
        customConfig: 'custconfig.js',
        toolbar: "{{$Scribite.editorVars.barmode}}",
        {{if $Scribite.editorVars.height}}height: "{{$Scribite.editorVars.height}}",{{/if}}
        {{if $Scribite.editorVars.skin}}skin: "{{$Scribite.editorVars.skin}}",{{/if}}
        {{if $Scribite.editorVars.uicolor}}uiColor: "{{$Scribite.editorVars.uicolor}}",{{/if}}
        {{if $Scribite.editorVars.langmode eq 'zklang'}}language: "{{$lang}}",{{/if}}
        {{if $Scribite.editorVars.resizemode eq 'resize'}}extraPlugins: 'resize', resize_enabled: true, removePlugins: 'autogrow', resize_minHeight: "{{$Scribite.editorVars.resizeminheight}}", resize_maxHeight : "{{$Scribite.editorVars.resizemaxheight}}",
        {{elseif $Scribite.editorVars.resizemode eq 'autogrow'}}extraPlugins: 'autogrow', removePlugins: 'resize', autoGrow_minHeight : "{{$Scribite.editorVars.growminheight}}", autoGrow_maxHeight : "{{$Scribite.editorVars.growmaxheight}}",
        {{else}}resize_enabled: false, removePlugins: 'autogrow,resize', extraPlugins: '',{{/if}}
        {{if $Scribite.editorVars.style_editor}}contentsCss: '{{$baseurl}}{{$Scribite.editorVars.style_editor}}',{{/if}}
        entities_greek: false, entities_latin: false,
// Zikula styling tags can be added optionally later on
//        format_tags: 'p;h1;h2;h3;h4;h5;h6;zsub;pre;address;div', for adding Zikula specific styles
//        format_zsub: { element: 'span', attributes: { 'class': 'z-sub' } },
        {{if $Scribite.editorVars.entermode}}enterMode: {{$Scribite.editorVars.entermode}},{{/if}}
        {{if $Scribite.editorVars.shiftentermode}}shiftEnterMode: {{$Scribite.editorVars.shiftentermode}},{{/if}}
        {{if $useckfinder eq true}}
        filebrowserBrowseUrl: '{{$Scribite.editorVars.filemanagerpath}}/ckfinder.html',
        filebrowserImageBrowseUrl: '{{$Scribite.editorVars.filemanagerpath}}/ckfinder.html?Type=Images',
        filebrowserFilesBrowseUrl: '{{$Scribite.editorVars.filemanagerpath}}/ckfinder.html?Type=Files',
        filebrowserFlashBrowseUrl: '{{$Scribite.editorVars.filemanagerpath}}/ckfinder.html?Type=Flash',
        filebrowserUploadUrl: '{{$Scribite.editorVars.filemanagerpath}}/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl: '{{$Scribite.editorVars.filemanagerpath}}/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserFilesUploadUrl: '{{$Scribite.editorVars.filemanagerpath}}/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserFlashUploadUrl: '{{$Scribite.editorVars.filemanagerpath}}/core/connector/php/connector.php?command=QuickUpload&type=Flash',
        {{/if}}
        {{if $usekcfinder eq true}}
        filebrowserBrowseUrl: '/{{$Scribite.editorVars.filemanagerpath}}/browse.php?type=files&s={{$session_id}}',
        filebrowserImageBrowseUrl: '/{{$Scribite.editorVars.filemanagerpath}}/browse.php?type=images&s={{$session_id}}',
        filebrowserFilesBrowseUrl: '/{{$Scribite.editorVars.filemanagerpath}}/browse.php?type=files&s={{$session_id}}',
        filebrowserFlashBrowseUrl: '/{{$Scribite.editorVars.filemanagerpath}}/browse.php?type=flash&s={{$session_id}}',
        filebrowserUploadUrl: '/{{$Scribite.editorVars.filemanagerpath}}/upload.php?type=files&s={{$session_id}}',
        filebrowserImageUploadUrl: '/{{$Scribite.editorVars.filemanagerpath}}/upload.php?type=images&s={{$session_id}}',
        filebrowserFilesUploadUrl: '/{{$Scribite.editorVars.filemanagerpath}}/upload.php?type=files&s={{$session_id}}',
        filebrowserFlashUploadUrl: '/{{$Scribite.editorVars.filemanagerpath}}/upload.php?type=flash&s={{$session_id}}',
        {{/if}}
    };
    {{if $Scribite.editorVars.extraplugins}}params.extraPlugins = params.extraPlugins + ',' + '{{$Scribite.editorVars.extraplugins}}';{{/if}}
    {{if !empty($Scribite.addExtEdPlugins)}}{{foreach from=$Scribite.addExtEdPlugins item='ePlugin'}}
    params.extraPlugins = params.extraPlugins + ',' + '{{$ePlugin.name}}';
    {{/foreach}}{{/if}}
    
    var ckload = function () {
        var textareaList = document.getElementsByTagName('textarea');
        for(i = 0; i < textareaList.length; i++) {
            // check to make sure textarea not in disabled list or has 'noeditor' class
            // this editor does not use jQuery or prototype so reverting to manual JS
            if ((disabledTextareas.indexOf(textareaList[i].id) == -1) && !(textareaList[i].className.split(' ').indexOf('noeditor') > -1)) {
                // override paramaters
                var oParams = new Object();
                CKEDITOR.tools.extend(oParams, params);
                var paramOverrideObj = window["paramOverrides_" + textareaList[i].id];
                if (typeof paramOverrideObj != "undefined") {
                    // override existing values in the `params` obj
                    CKEDITOR.tools.extend(oParams, paramOverrideObj, true);
                }
                if (typeof paramOverrides_all != "undefined") {
                    // override existing values in if 'all' is set as textarea for override
                    // overrides individual textarea overrides!
                    CKEDITOR.tools.extend(oParams, paramOverrides_all, true);
                }
                // attach the editor
                var {{$Scribite.modname}}Editor = CKEDITOR.replace(textareaList[i].id, oParams);
                // notify subscriber
                insertNotifyInput(textareaList[i].id);
            }
        }
    }

    if (window.addEventListener) { // modern browsers
        window.addEventListener('load' , ckload, false);
    } else if (window.attachEvent) { // ie8 and even older browsers
        window.attachEvent('onload', ckload);
    } else { // fallback, not truly necessary
        window.onload = ckload;
    }

/* ]]> */
</script>
<!-- end Scribite with CKEditor -->
