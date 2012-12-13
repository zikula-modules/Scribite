<!-- start Scribite with CKEditor for {$Scribite.modname} -->
{pageaddvar name="javascript" value="prototype"}
{pageaddvar name="stylesheet" value="modules/Scribite/plugins/CKEditor/style/style.css"}
{pageaddvar name="javascript" value="modules/Scribite/plugins/CKEditor/vendor/ckeditor/ckeditor.js"}

{assign value=false var='useckfinder'}
{assign value=false var='usekcfinder'}

{if file_exists("`$Scribite.editorVars.filemanagerpath`/ckfinder.html")}{assign var="useckfinder" value=true}<script type="text/javascript" src="{$Scribite.editorVars.filemanagerpath}/ckfinder.js"></script>
{elseif file_exists("`$Scribite.editorVars.filemanagerpath`/browse.php")}{assign var="usekcfinder" value=true}{/if}
<script type="text/javascript">
/* <![CDATA[ */
{{if $Scribite.modareas eq "all" or $Scribite.modareas|substr:0:4 eq "all:"}}

    ckload = function () {
        var allTextAreas = document.getElementsByTagName("textarea");
        for (var i=0; i < allTextAreas.length; i++) {
            var {{$Scribite.modname}}Editor = CKEDITOR.replace(allTextAreas[i].id, {
                {{if $Scribite.editorVars.customconfigfile}}customConfig: 'modules/Scribite/plugins/CKEditor/vendor/ckeditor/custconfig.js',{{/if}}
                toolbar: "{{if $Scribite.modareas|substr:0:4 eq "all:"}}{{$Scribite.modareas|substr:4}}{{else}}{{$Scribite.editorVars.barmode}}{{/if}}",
                {{if $Scribite.editorVars.skin}}skin: "{{$Scribite.editorVars.skin}}",{{/if}}
                {{if $Scribite.editorVars.language|strlen eq 2}}language: "{{$Scribite.editorVars.language}}",{{/if}}
                {{if $Scribite.editorVars.extraplugins}}extraPlugins: '{{$Scribite.editorVars.extraplugins}}',{{/if}}
                {{if $Scribite.editorVars.maxheight}}removePlugins: 'resize', autoGrow_maxHeight : "{{$Scribite.editorVars.maxheight}}",{{/if}}
                {{if $Scribite.editorVars.style_editor}}contentsCss : '{{$baseurl}}{{$Scribite.editorVars.style_editor}}',{{/if}}
                entities_greek: false, 
                entities_latin: false,
                {{if $useckfinder eq true}}
                filebrowserBrowseUrl : '{{$Scribite.editorVars.filemanagerpath}}/ckfinder.html',
                filebrowserImageBrowseUrl : '{{$Scribite.editorVars.filemanagerpath}}/ckfinder.html?Type=Images',
                filebrowserFilesBrowseUrl : '{{$Scribite.editorVars.filemanagerpath}}/ckfinder.html?Type=Files',
                filebrowserFlashBrowseUrl : '{{$Scribite.editorVars.filemanagerpath}}/ckfinder.html?Type=Flash',
                filebrowserUploadUrl : '{{$Scribite.editorVars.filemanagerpath}}/core/connector/php/connector.php?command=QuickUpload&type=Files',
                filebrowserImageUploadUrl : '{{$Scribite.editorVars.filemanagerpath}}/core/connector/php/connector.php?command=QuickUpload&type=Images',
                filebrowserFilesUploadUrl : '{{$Scribite.editorVars.filemanagerpath}}/core/connector/php/connector.php?command=QuickUpload&type=Files',
                filebrowserFlashUploadUrl : '{{$Scribite.editorVars.filemanagerpath}}/core/connector/php/connector.php?command=QuickUpload&type=Flash',
                {{/if}}
                {{if $usekcfinder eq true}}
                filebrowserBrowseUrl: '/{{$Scribite.editorVars.filemanagerpath}}/browse.php?type=files',
                filebrowserImageBrowseUrl: '/{{$Scribite.editorVars.filemanagerpath}}/browse.php?type=images',
                filebrowserFilesBrowseUrl: '/{{$Scribite.editorVars.filemanagerpath}}/browse.php?type=files',
                filebrowserFlashBrowseUrl: '/{{$Scribite.editorVars.filemanagerpath}}/browse.php?type=flash',
                filebrowserUploadUrl : '/{{$Scribite.editorVars.filemanagerpath}}/upload.php?type=files',
                filebrowserImageUploadUrl : '/{{$Scribite.editorVars.filemanagerpath}}/upload.php?type=images',
                filebrowserFilesUploadUrl : '/{{$Scribite.editorVars.filemanagerpath}}/upload.php?type=files',
                filebrowserFlashUploadUrl : '/{{$Scribite.editorVars.filemanagerpath}}/upload.php?type=flash',
                {{/if}}
            });
        }
    }
    
{{else}}

    ckload = function () {

        {{foreach from=$Scribite.modareas item="area"}}
			{{if $area|strpos:':' gt 0}}{{assign var='colonpos' value=$area|strpos:':'}}{{else}}{{assign var='colonpos' value=0}}{{/if}}
            var {{$Scribite.modname}}Editor = CKEDITOR.replace('{{if $colonpos gt 0}}{{$area|substr:0:$colonpos}}{{else}}{{$area}}{{/if}}', {
                {{if $Scribite.editorVars.customconfigfile}}customConfig: 'modules/Scribite/plugins/CKEditor/vendor/ckeditor/custconfig.js',{{/if}}
                toolbar: "{{if $colonpos gt 0}}{{$area|substr:$colonpos+1}}{{else}}{{$barmode}}{{/if}}",
                {{if $Scribite.editorVars.skin}}skin: "{{$Scribite.editorVars.skin}}",{{/if}}
                {{if $Scribite.editorVars.language|strlen eq 2}}language: "{{$Scribite.editorVars.language}}",{{/if}}
                {{if $Scribite.editorVars.extraplugins}}extraPlugins: '{{$Scribite.editorVars.extraplugins}}',{{/if}}
                {{if $Scribite.editorVars.maxheight}}removePlugins: 'resize', autoGrow_maxHeight : "{{$Scribite.editorVars.maxheight}}",{{/if}}
                {{if $Scribite.editorVars.style_editor}}contentsCss : '{{$baseurl}}{{$Scribite.editorVars.style_editor}}',{{/if}}
                entities_greek: false,
                entities_latin: false,
                {{if $useckfinder eq true}}
                filebrowserBrowseUrl : '{{$Scribite.editorVars.filemanagerpath}}/ckfinder.html',
                filebrowserImageBrowseUrl : '{{$Scribite.editorVars.filemanagerpath}}/ckfinder.html?Type=Images',
                filebrowserFilesBrowseUrl : '{{$Scribite.editorVars.filemanagerpath}}/ckfinder.html?Type=Files',
                filebrowserFlashBrowseUrl : '{{$Scribite.editorVars.filemanagerpath}}/ckfinder.html?Type=Flash',
                filebrowserUploadUrl : '{{$Scribite.editorVars.filemanagerpath}}/core/connector/php/connector.php?command=QuickUpload&type=Files',
                filebrowserImageUploadUrl : '{{$Scribite.editorVars.filemanagerpath}}/core/connector/php/connector.php?command=QuickUpload&type=Images',
                filebrowserFilesUploadUrl : '{{$Scribite.editorVars.filemanagerpath}}/core/connector/php/connector.php?command=QuickUpload&type=Files',
                filebrowserFlashUploadUrl : '{{$Scribite.editorVars.filemanagerpath}}/core/connector/php/connector.php?command=QuickUpload&type=Flash',
                {{/if}}
                {{if $usekcfinder eq true}}
                filebrowserBrowseUrl: '/{{$Scribite.editorVars.filemanagerpath}}/browse.php?type=files',
                filebrowserImageBrowseUrl: '/{{$Scribite.editorVars.filemanagerpath}}/browse.php?type=images',
                filebrowserFilesBrowseUrl: '/{{$Scribite.editorVars.filemanagerpath}}/browse.php?type=files',
                filebrowserFlashBrowseUrl: '/{{$Scribite.editorVars.filemanagerpath}}/browse.php?type=flash',
                filebrowserUploadUrl : '/{{$Scribite.editorVars.filemanagerpath}}/upload.php?type=files',
                filebrowserImageUploadUrl : '/{{$Scribite.editorVars.filemanagerpath}}/upload.php?type=images',
                filebrowserFilesUploadUrl : '/{{$Scribite.editorVars.filemanagerpath}}/upload.php?type=files',
                filebrowserFlashUploadUrl : '/{{$Scribite.editorVars.filemanagerpath}}/upload.php?type=flash',
                {{/if}}
                {{if $modvars.Scribite.image_upload}}
                filebrowserBrowseUrl : 'index.php?module=Scribite&type=user&func=browseImages&editor=ckeditor',
                filebrowserImageBrowseUrl : 'index.php?module=Scribite&type=user&func=browseImages&editor=ckeditor',
                {{/if}}
            });
        {{/foreach}}
    }
    
{{/if}}

Event.observe(window, 'load', ckload);

/* ]]> */
</script>
<!-- end Scribite with CKEditor -->