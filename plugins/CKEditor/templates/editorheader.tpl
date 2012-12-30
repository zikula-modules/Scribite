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
<script type="text/javascript">
/* <![CDATA[ */
    var params = {
        {{if $Scribite.editorVars.customconfigfile}}customConfig: '{{$Scribite.editorVars.customconfigfile}}',{{/if}}
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
        filebrowserBrowseUrl: '/{{$Scribite.editorVars.filemanagerpath}}/browse.php?type=files',
        filebrowserImageBrowseUrl: '/{{$Scribite.editorVars.filemanagerpath}}/browse.php?type=images',
        filebrowserFilesBrowseUrl: '/{{$Scribite.editorVars.filemanagerpath}}/browse.php?type=files',
        filebrowserFlashBrowseUrl: '/{{$Scribite.editorVars.filemanagerpath}}/browse.php?type=flash',
        filebrowserUploadUrl: '/{{$Scribite.editorVars.filemanagerpath}}/upload.php?type=files',
        filebrowserImageUploadUrl: '/{{$Scribite.editorVars.filemanagerpath}}/upload.php?type=images',
        filebrowserFilesUploadUrl: '/{{$Scribite.editorVars.filemanagerpath}}/upload.php?type=files',
        filebrowserFlashUploadUrl: '/{{$Scribite.editorVars.filemanagerpath}}/upload.php?type=flash',
        {{/if}}
        {{if $modvars.Scribite.image_upload}}
        filebrowserBrowseUrl: 'index.php?module=Scribite&type=user&func=browseImages&editor=ckeditor',
        filebrowserImageBrowseUrl: 'index.php?module=Scribite&type=user&func=browseImages&editor=ckeditor',
        {{/if}}
    };
    {{if $Scribite.editorVars.barmode eq 'Standard'}}
	// Remove some buttons, provided by the standard plugins, which we don't need to have in the Standard(s) toolbar.
	params.removeButtons = 'Underline,Subscript,Superscript';
	{{elseif $Scribite.editorVars.barmode eq 'Extended'}}
	// Add the extraplugins if specified
	params.extraPlugins = params.extraPlugins + ',' + 'colorbutton,div,flash,font,pagebreak,stylescombo,tableresize,undo';
	{{/if}}
    {{if $Scribite.editorVars.extraplugins}}params.extraPlugins = params.extraPlugins + ',' + '{{$Scribite.editorVars.extraplugins}}';{{/if}}

    var ckload = function () {
        var textareaList = document.getElementsByTagName('textarea');
        for(i = 0; i < textareaList.length; i++) {
        // check to make sure textarea not in disabled list or has 'noeditor' class
        // this editor does not use jQuery or prototype so reverting to manual JS - this may not work...
        if ((disabledTextareas.indexOf(textareaList[i].id) == -1) && !(textareaList[i].class == 'noeditor')) {
                // attach the editor
                var {{$Scribite.modname}}Editor = CKEDITOR.replace(textareaList[i].id, params);
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