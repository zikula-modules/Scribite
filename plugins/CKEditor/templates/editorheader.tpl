<!-- start Scribite with CKEditor for {$Scribite.modname} -->{strip}
{pageaddvar name='javascript' value='jquery'}
{if (isset($modvars.Theme.cssjscombine) && $modvars.Theme.cssjscombine|default:false) || (isset($modvars.ZikulaThemeModule.cssjscombine) && $modvars.ZikulaThemeModule.cssjscombine|default:false)}
    {* needs to be placed before the CKEditor files are included. *}
    {pageaddvar name='javascript' value='modules/Scribite/plugins/CKEditor/javascript/CKEditor.url.js'}
{/if}
{pageaddvar name='stylesheet' value='modules/Scribite/plugins/CKEditor/style/style.css'}
{pageaddvar name='javascript' value='modules/Scribite/plugins/CKEditor/vendor/ckeditor/ckeditor.js'}
{pageaddvar name='javascript' value='modules/Scribite/plugins/CKEditor/vendor/ckeditor/adapters/jquery.js'}
{pageaddvar name='javascript' value='modules/Scribite/plugins/CKEditor/javascript/CKEditor.ajaxApi.js'}

{assign value=false var='useckfinder'}
{assign value=false var='usekcfinder'}

{if file_exists("`$Scribite.editorVars.filemanagerpath`/ckfinder.html")}
    {assign var='useckfinder' value=true}
    <script type="text/javascript" src="{$Scribite.editorVars.filemanagerpath}/ckfinder.js"></script>
{elseif file_exists("`$Scribite.editorVars.filemanagerpath`/browse.php")}
    {assign var='usekcfinder' value=true}
{/if}
{callfunc x_function='session_id' x_assign='session_id'}
{/strip}
<script type="text/javascript">
/* <![CDATA[ */
    {{if !empty($Scribite.addExtEdPlugins)}}
        {{foreach item='ePlugin' from=$Scribite.addExtEdPlugins}}
            CKEDITOR.plugins.addExternal('{{$ePlugin.name}}', Zikula.Config.baseURL+'{{$ePlugin.path}}','{{$ePlugin.file}}');
        {{/foreach}}
    {{/if}}

    var editorOptions = {
        customConfig: 'custconfig.js',
        toolbar: '{{$Scribite.editorVars.barmode}}',
        {{if $Scribite.editorVars.height}}height: '{{$Scribite.editorVars.height}}',{{/if}}
        {{if $Scribite.editorVars.skin}}skin: '{{$Scribite.editorVars.skin}}',{{/if}}
        {{if $Scribite.editorVars.uicolor}}uiColor: '{{$Scribite.editorVars.uicolor}}',{{/if}}
        {{if $Scribite.editorVars.langmode eq 'zklang'}}language: '{{$lang}}',{{/if}}
        {{if $Scribite.editorVars.resizemode eq 'resize'}}extraPlugins: 'resize', resize_enabled: true, removePlugins: 'autogrow', resize_minHeight: '{{$Scribite.editorVars.resizeminheight}}', resize_maxHeight: '{{$Scribite.editorVars.resizemaxheight}}',
        {{elseif $Scribite.editorVars.resizemode eq 'autogrow'}}extraPlugins: 'autogrow', removePlugins: 'resize', autoGrow_minHeight: '{{$Scribite.editorVars.growminheight}}', autoGrow_maxHeight: '{{$Scribite.editorVars.growmaxheight}}',
        {{else}}resize_enabled: false, removePlugins: 'autogrow,resize', extraPlugins: '',{{/if}}
        {{if $Scribite.editorVars.style_editor}}contentsCss: '{{$baseurl}}{{$Scribite.editorVars.style_editor}}',{{/if}}
        entities_greek: false, entities_latin: false,
{{* Zikula styling tags can be added optionally later on
//        format_tags: 'p;h1;h2;h3;h4;h5;h6;zsub;pre;address;div', for adding Zikula specific styles
//        format_zsub: { element: 'span', attributes: { 'class': 'z-sub' } },
*}}
        {{if $Scribite.editorVars.entermode}}enterMode: {{$Scribite.editorVars.entermode}},{{/if}}
        {{if $Scribite.editorVars.shiftentermode}}shiftEnterMode: {{$Scribite.editorVars.shiftentermode}},{{/if}}
        {{capture assign='fmPath'}}{{$baseurl}}{{$Scribite.editorVars.filemanagerpath}}/{{/capture}}
        {{if $useckfinder eq true}}
            filebrowserBrowseUrl: '{{$fmPath}}ckfinder.html',
            filebrowserImageBrowseUrl: '{{$fmPath}}ckfinder.html?Type=Images',
            filebrowserFilesBrowseUrl: '{{$fmPath}}ckfinder.html?Type=Files',
            filebrowserFlashBrowseUrl: '{{$fmPath}}ckfinder.html?Type=Flash',
            filebrowserUploadUrl: '{{$fmPath}}core/connector/php/connector.php?command=QuickUpload&type=Files',
            filebrowserImageUploadUrl: '{{$fmPath}}core/connector/php/connector.php?command=QuickUpload&type=Images',
            filebrowserFilesUploadUrl: '{{$fmPath}}core/connector/php/connector.php?command=QuickUpload&type=Files',
            filebrowserFlashUploadUrl: '{{$fmPath}}core/connector/php/connector.php?command=QuickUpload&type=Flash',
        {{elseif $usekcfinder eq true}}
            filebrowserBrowseUrl: '{{$fmPath}}browse.php?type=files&s={{$session_id}}',
            filebrowserImageBrowseUrl: '{{$fmPath}}browse.php?type=images&s={{$session_id}}',
            filebrowserFilesBrowseUrl: '{{$fmPath}}browse.php?type=files&s={{$session_id}}',
            filebrowserFlashBrowseUrl: '{{$fmPath}}browse.php?type=flash&s={{$session_id}}',
            filebrowserUploadUrl: '{{$fmPath}}upload.php?type=files&s={{$session_id}}',
            filebrowserImageUploadUrl: '{{$fmPath}}upload.php?type=images&s={{$session_id}}',
            filebrowserFilesUploadUrl: '{{$fmPath}}upload.php?type=files&s={{$session_id}}',
            filebrowserFlashUploadUrl: '{{$fmPath}}upload.php?type=flash&s={{$session_id}}',
        {{/if}}
    };
    editorOptions.extraPlugins = editorOptions.extraPlugins + ',oembed';
    {{if $Scribite.editorVars.extraplugins}}editorOptions.extraPlugins = editorOptions.extraPlugins + ',' + '{{$Scribite.editorVars.extraplugins}}';{{/if}}
    {{if !empty($Scribite.addExtEdPlugins)}}
        {{foreach item='ePlugin' from=$Scribite.addExtEdPlugins}}
            editorOptions.extraPlugins = editorOptions.extraPlugins + ',' + '{{$ePlugin.name}}';
        {{/foreach}}
    {{/if}}

    (function($) {
        $(document).ready(function() {
            // instantiate Scribite object for editor creation and ajax manipulation
            Scribite = new ScribiteUtil(editorOptions);
            Scribite.createEditors();
        });
    })(jQuery)
/* ]]> */
</script>
<!-- end Scribite with CKEditor for {$Scribite.modname} -->
