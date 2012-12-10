<!-- start Scribite with CKEditor for {$modname} -->
{pageaddvar name="stylesheet" value="modules/Scribite/plugins/CKEditor/style/style.css"}
{pageaddvar name="javascript" value="modules/Scribite/plugins/CKEditor/vendor/ckeditor/ckeditor.js"}

{if file_exists("`$filemanagerpath`/ckfinder.html")}{assign var="useckfinder" value=true}<script type="text/javascript" src="{$filemanagerpath}/ckfinder.js"></script>
{elseif file_exists("`$filemanagerpath`/browse.php")}{assign var="usekcfinder" value=true}{/if}
<script type="text/javascript">
/* <![CDATA[ */
{{if $modareas eq "all"}}

    ckload = function () {
        var allTextAreas = document.getElementsByTagName("textarea");
        for (var i=0; i < allTextAreas.length; i++) {
            var {{$modname}}Editor = CKEDITOR.replace(allTextAreas[i].id, {
                {{if $customconfigfile}}customConfig: '/{{$editors_path}}/{{$editor_dir}}/{{$customconfigfile}}',{{/if}}
                toolbar: "{{if $modareas|substr:0:4 eq "all:"}}{{$modareas|substr:4}}{{else}}{{$barmode}}{{/if}}",
                skin: "{{$skin}}",
                {{if $language|strlen eq 2}}language: "{{$language}}",{{/if}}
                {{if $extraplugins}}extraPlugins: '{{$extraplugins}}',{{/if}}
                {{if $maxheight}}removePlugins: 'resize', autoGrow_maxHeight : "{{$maxheight}}",{{/if}}
                contentsCss : '{{$zBaseUrl}}/{{$style_editor}}',
                entities_greek: false, 
                entities_latin: false,
                {{if $useckfinder eq true}}
                filebrowserBrowseUrl : '{{$filemanagerpath}}/ckfinder.html',
                filebrowserImageBrowseUrl : '{{$filemanagerpath}}/ckfinder.html?Type=Images',
                filebrowserFilesBrowseUrl : '{{$filemanagerpath}}/ckfinder.html?Type=Files',
                filebrowserFlashBrowseUrl : '{{$filemanagerpath}}/ckfinder.html?Type=Flash',
                filebrowserUploadUrl : '{{$filemanagerpath}}/core/connector/php/connector.php?command=QuickUpload&type=Files',
                filebrowserImageUploadUrl : '{{$filemanagerpath}}/core/connector/php/connector.php?command=QuickUpload&type=Images',
                filebrowserFilesUploadUrl : '{{$filemanagerpath}}/core/connector/php/connector.php?command=QuickUpload&type=Files',
                filebrowserFlashUploadUrl : '{{$filemanagerpath}}/core/connector/php/connector.php?command=QuickUpload&type=Flash',
                {{/if}}
                {{if $usekcfinder eq true}}
                filebrowserBrowseUrl: '/{{$filemanagerpath}}/browse.php?type=files',
                filebrowserImageBrowseUrl: '/{{$filemanagerpath}}/browse.php?type=images',
                filebrowserFilesBrowseUrl: '/{{$filemanagerpath}}/browse.php?type=files',
                filebrowserFlashBrowseUrl: '/{{$filemanagerpath}}/browse.php?type=flash',
                {{/if}}
            });
        }
    }
    
{{else}}

    ckload = function () {

        {{foreach from=$modareas item="area"}}
            var {{$modname}}Editor = CKEDITOR.replace('{{$area}}', {
                {{if $customconfigfile}}customConfig: '/{{$editors_path}}/{{$editor_dir}}/{{$customconfigfile}}',{{/if}}
                toolbar: "{{if $colonpos gt 0}}{{$area|substr:$colonpos+1}}{{else}}{{$barmode}}{{/if}}",
                skin: "{{$skin}}",
                {{if $language|strlen eq 2}}language: "{{$language}}",{{/if}}
                {{if $extraplugins}}extraPlugins: '{{$extraplugins}}',{{/if}}
                {{if $maxheight}}removePlugins: 'resize', autoGrow_maxHeight : "{{$maxheight}}",{{/if}}
                contentsCss : '{{$zBaseUrl}}/{{$style_editor}}',
                entities_greek: false,
                entities_latin: false,
                {{if $useckfinder eq true}}
                filebrowserBrowseUrl : '{{$filemanagerpath}}/ckfinder.html',
                filebrowserImageBrowseUrl : '{{$filemanagerpath}}/ckfinder.html?Type=Images',
                filebrowserFilesBrowseUrl : '{{$filemanagerpath}}/ckfinder.html?Type=Files',
                filebrowserFlashBrowseUrl : '{{$filemanagerpath}}/ckfinder.html?Type=Flash',
                filebrowserUploadUrl : '{{$filemanagerpath}}/core/connector/php/connector.php?command=QuickUpload&type=Files',
                filebrowserImageUploadUrl : '{{$filemanagerpath}}/core/connector/php/connector.php?command=QuickUpload&type=Images',
                filebrowserFilesUploadUrl : '{{$filemanagerpath}}/core/connector/php/connector.php?command=QuickUpload&type=Files',
                filebrowserFlashUploadUrl : '{{$filemanagerpath}}/core/connector/php/connector.php?command=QuickUpload&type=Flash',
                {{/if}}
                {{if $usekcfinder eq true}}
                filebrowserBrowseUrl: '/{{$filemanagerpath}}/browse.php?type=files',
                filebrowserImageBrowseUrl: '/{{$filemanagerpath}}/browse.php?type=images',
                filebrowserFilesBrowseUrl: '/{{$filemanagerpath}}/browse.php?type=files',
                filebrowserFlashBrowseUrl: '/{{$filemanagerpath}}/browse.php?type=flash',
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