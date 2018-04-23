<!-- start Scribite with CKEditor for {$Scribite.modname} -->{strip}
{pageaddvar name='javascript' value='jquery'}
{* needs to be placed before the CKEditor files are included. *}
{pageaddvar name='javascript' value='modules/Scribite/plugins/CKEditor/javascript/CKEditor.url.js'}
{pageaddvar name='stylesheet' value='modules/Scribite/plugins/CKEditor/style/style.css'}
{pageaddvar name='javascript' value='modules/Scribite/plugins/CKEditor/vendor/ckeditor/ckeditor.js'}
{pageaddvar name='javascript' value='modules/Scribite/plugins/CKEditor/vendor/ckeditor/adapters/jquery.js'}
{pageaddvar name='javascript' value='modules/Scribite/plugins/CKEditor/javascript/CKEditor.ajaxApi.js'}

{assign value=false var='usezfiler'}
{assign value=false var='useckfinder'}
{assign value=false var='usekcfinder'}

{if file_exists("modules/Zfiler/javascript/zfiler_cke.js")}
    {assign var='usezfiler' value=true}
    {if $coredata.version_num < '1.4.0'}
        {pageaddvar name='stylesheet' value='javascript/jquery-ui-1.12/themes/base/jquery-ui.css'}
        {pageaddvar name='javascript' value='javascript/jquery-ui-1.12/jquery-ui.min.js'}
    {else}
        {pageaddvar name='stylesheet' value='web/jquery-ui/themes/base/jquery-ui.css'}
    {/if}
    <script type="text/javascript" src="modules/Zfiler/javascript/zfiler_cke.js"></script>
    <style>.ui-dialog { z-index: 10050 !important ;}</style>
{elseif file_exists("`$Scribite.editorVars.filemanagerpath`/ckfinder.html")}
    {assign var='useckfinder' value=true}
    <script type="text/javascript" src="{$Scribite.editorVars.filemanagerpath}/ckfinder.js"></script>
{elseif file_exists("`$Scribite.editorVars.filemanagerpath`/browse.php")}
    {assign var='usekcfinder' value=true}
{/if}
{callfunc x_function='session_id' x_assign='session_id'}
{/strip}
<script type="text/javascript">
    {{if !empty($Scribite.addExtEdPlugins)}}
        {{foreach item='ePlugin' from=$Scribite.addExtEdPlugins}}
            CKEDITOR.plugins.addExternal('{{$ePlugin.name}}', Zikula.Config.baseURL+'{{$ePlugin.path}}','{{$ePlugin.file}}');
        {{/foreach}}
    {{/if}}

    var editorOptions = {
        customConfig: 'custconfig.js',
        {{if $Scribite.editorVars.height}}height: '{{$Scribite.editorVars.height}}',{{/if}}
        {{if $Scribite.editorVars.skin}}skin: '{{$Scribite.editorVars.skin}}',{{/if}}
        {{if $Scribite.editorVars.uicolor}}uiColor: '{{$Scribite.editorVars.uicolor}}',{{/if}}
        {{if $Scribite.editorVars.langmode eq 'zklang'}}language: '{{$lang}}',{{/if}}
        {{if $Scribite.editorVars.style_editor}}contentsCss: '{{$baseurl}}{{$Scribite.editorVars.style_editor}}',{{/if}}
{{* Zikula styling tags can be added optionally later on
//        format_tags: 'p;h1;h2;h3;h4;h5;h6;zsub;pre;address;div', for adding Zikula specific styles
//        format_zsub: { element: 'span', attributes: { 'class': 'z-sub' } },
*}}
        {{if $Scribite.editorVars.entermode}}enterMode: {{$Scribite.editorVars.entermode}},{{/if}}
        {{if $Scribite.editorVars.shiftentermode}}shiftEnterMode: {{$Scribite.editorVars.shiftentermode}},{{/if}}
        {{capture assign='fmPath'}}{{$baseurl}}{{$Scribite.editorVars.filemanagerpath}}/{{/capture}}
        {{if $usezfiler eq true}}
            filebrowserBrowseUrl: '#',
        {{elseif $useckfinder eq true}}
            filebrowserBrowseUrl: '{{$fmPath}}ckfinder.html',
        {{elseif $usekcfinder eq true}}
            filebrowserBrowseUrl: '{{$fmPath}}browse.php?type=files&s={{$session_id}}',
        {{/if}}
        filebrowserUploadUrl:'{{$baseurl}}ajax.php?module=Scribite&type=ajax&func=upload&csrftoken={{insert name="csrftoken"}}',
    };
    CKEDITOR.config.imageplus = { 
        icon: 'image-red', 
        base64option: true, 
        base64_localfile: true, 
        a_copy_attr_rel: 'lightbox[grp]' };
    editorOptions.extraPlugins = ',btgrid,codemirror,image2,imageplus,wordcount,openlink,googlesearch,youtube';
    {{if $Scribite.editorVars.extraplugins}}
        editorOptions.extraPlugins += ',' + '{{$Scribite.editorVars.extraplugins}}';
    {{/if}}
    {{if !empty($Scribite.addExtEdPlugins)}}
        {{foreach item='ePlugin' from=$Scribite.addExtEdPlugins}}
            editorOptions.extraPlugins += ',' + '{{$ePlugin.name}}';
        {{/foreach}}
    {{/if}}
    editorOptions.removeButtons += (editorOptions.removeButtons ? ',' : '') + 'NewPage,Templates,PasteFromWord';
    editorOptions.removePlugins += (editorOptions.removePlugins ? ',' : '') + 'image,templates,language,forms';
    editorOptions.extraPlugins += ',zoom';
    editorOptions.extraPlugins += ',lineheight';
    editorOptions.extraPlugins += ',texttransform';
    editorOptions.extraPlugins += ',scayt';
    editorOptions.extraPlugins += ',wenzgmap';
    editorOptions.extraPlugins += ',leaflet';
    editorOptions.extraPlugins += ',videosnapshot';
    editorOptions.extraPlugins += ',html5video';
    editorOptions.extraPlugins += ',html5audio';
    editorOptions.extraPlugins += ',ckawesome';
    editorOptions.extraPlugins += ',yaqr'; // QR code
    editorOptions.extraPlugins += ',ckawesome';
    editorOptions.extraPlugins += ',embed';
    //editorOptions.removePlugins += ',embed';
    editorOptions.extraPlugins += ',autosave';
    //editorOptions.removePlugins += ',autosave';
    //editorOptions.extraPlugins += ',bidi';
    editorOptions.removePlugins += ',bidi';
    {{if $Scribite.editorVars.resizemode eq 'resize'}}
        editorOptions.extraPlugins += ',resize';
        editorOptions.removePlugins += ',autogrow';
        editorOptions.resize_enabled = true;
        editorOptions.resize_minHeight = '{{$Scribite.editorVars.resizeminheight}}';
        editorOptions.resize_maxHeight = '{{$Scribite.editorVars.resizemaxheight}}';
    {{elseif $Scribite.editorVars.resizemode eq 'autogrow'}}
        editorOptions.extraPlugins += ',autogrow';
        editorOptions.removePlugins += ',resize';
        editorOptions.autoGrow_minHeight = '{{$Scribite.editorVars.growminheight}}'; 
        editorOptions.autoGrow_maxHeight = '{{$Scribite.editorVars.growmaxheight}}';
    {{else}}
        editorOptions.removePlugins += ',autogrow,resize';
        editorOptions.resize_enabled = false;
    {{/if}}
{{if $Scribite.editorVars.barmode == 'Basic' }}
    editorOptions.removeButtons += ',CopyFormatting,autoFormat,SelectAll,Strike,Subscript,Superscript,Outdent,Indent,Blockquote,CreateDiv,Unlink,Anchor,Flash,HorizontalRule,Smiley,SpecialChar,PageBreak,Iframe,btgrid,Source,ckawesome,Table';
    editorOptions.removePlugins += ',zoom,codemirror,yaqr,html5video,html5audio,imageplus,videosnapshot';
    editorOptions.startupOutlineBlocks = false;
    editorOptions.toolbarGroups = [
		{ name: 'tools', groups: [ 'tools', 'cleanup', 'undo' ] },
		{ name: 'basicstyles', groups: [ 'basicstyles', 'align', 'list' ] },
		{ name: 'links', groups: [ 'links', 'image' ] },
		{ name: 'insert', groups: [ 'media', 'insert' ] }
	];
{{elseif $Scribite.editorVars.barmode == 'Simple' }}
    editorOptions.removeButtons += ',CopyFormatting,autoFormat,SelectAll,Strike,Subscript,Superscript,Outdent,Indent,Blockquote,CreateDiv,Unlink,Anchor,Flash,HorizontalRule,Smiley,SpecialChar,PageBreak,Iframe,btgrid,ckawesome';
    editorOptions.removeButtons += ',searchCode,CommentSelectedRange,UncommentSelectedRange,AutoComplete';
    editorOptions.toolbarGroups = [
		{ name: 'tools', groups: [ 'tools', 'clipboard', 'cleanup', 'undo' ] },
		{ name: 'basicstyles', groups: [ 'basicstyles' ] },
		{ name: 'paragraph', groups: [ 'align', 'list', 'indent', 'bidi' ] },
		{ name: 'links', groups: [ 'links', 'image', 'Uploadcare' ] },
		{ name: 'insert', groups: [ 'media', 'insert',  'others' ] },
		{ name: 'about', groups: [ 'about' ] }
	];
{{elseif $Scribite.editorVars.barmode == 'Standard' }}
    editorOptions.removeButtons += ',CopyFormatting,autoFormat,SelectAll,Anchor,btgrid,Print';
    editorOptions.removeButtons += ',Styles,Format';
    editorOptions.removeButtons += ',searchCode,CommentSelectedRange,UncommentSelectedRange,AutoComplete';
    editorOptions.removePlugins += ',zoom,videosnapshot,lineheight';
    editorOptions.toolbarGroups = [
		{ name: 'tools', groups: [ 'tools', 'mode', 'clipboard', 'cleanup', 'undo' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'links', groups: [ 'links', 'image', 'Uploadcare', 'media', 'insert' ] },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'texttransform' ] },
		{ name: 'paragraph', groups: [ 'align', 'list', 'indent', 'blocks', 'bidi' ] },
		{ name: 'styles', groups: [ 'styles', 'colors' ] },
		{ name: 'others', groups: [ 'others' ] },
		{ name: 'about', groups: [ 'about' ] }
	];
{{else}}
    editorOptions.extraPlugins += ',codeTag';
    editorOptions.toolbarGroups = [
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'mode', groups: [ 'mode' ] },
		{ name: 'document', groups: [ 'document', 'doctools', 'clipboard', 'cleanup', 'undo' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		{ name: 'forms', groups: [ 'forms' ] },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles' ] },
		{ name: 'paragraph', groups: [ 'align', 'list', 'indent', 'paragraph' ] },
		{ name: 'links', groups: [ 'links', 'image', 'Uploadcare' ] },
		{ name: 'insert', groups: [ 'media', 'insert' ] },
		'/',
		{ name: 'texttransform', groups: [ 'texttransform' ] },
		{ name: 'styles', groups: [ 'blocks', 'bidi', 'styles' ] },
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'others', groups: [ 'others' ] },
		{ name: 'about', groups: [ 'about' ] }
	];
{{/if}}

    (function($) {
        $(document).ready(function() {
            // instantiate Scribite object for editor creation and ajax manipulation
            Scribite = new ScribiteUtil(editorOptions);
            Scribite.createEditors();
        });
    })(jQuery)
</script>
<!-- end Scribite with CKEditor for {$Scribite.modname} -->
