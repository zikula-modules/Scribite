<!-- start Scribite with CKEditor for {$modname} -->
{pageaddvar name="stylesheet" value="modules/Scribite/style/ckeditor/style.css"}
<script type="text/javascript" src="{$editors_path}/{$editor_dir}/ckeditor.js"></script>
{if file_exists("`$ckeditor_filemanagerpath`/ckfinder.html")}{assign var="useckfinder" value=true}<script type="text/javascript" src="{$ckeditor_filemanagerpath}/ckfinder.js"></script>
{elseif file_exists("`$ckeditor_filemanagerpath`/browse.php")}{assign var="usekcfinder" value=true}{/if}
<script type="text/javascript">
/* <![CDATA[ */
{{if $modareas eq "all" or $modareas|substr:0:4 eq "all:"}}

    ckload = function () {
        var allTextAreas = document.getElementsByTagName("textarea");
        for (var i=0; i < allTextAreas.length; i++) {
            var {{$modname}}Editor = CKEDITOR.replace(allTextAreas[i].id, {
                {{if $ckeditor_customconfigfile}}customConfig: '/{{$editors_path}}/{{$editor_dir}}/{{$ckeditor_customconfigfile}}',{{/if}}
                toolbar: "{{if $modareas|substr:0:4 eq "all:"}}{{$modareas|substr:4}}{{else}}{{$ckeditor_barmode}}{{/if}}",
                skin: "{{$ckeditor_skin}}",
                {{if $ckeditor_language|strlen eq 2}}language: "{{$ckeditor_language}}",{{/if}}
                {{if $ckeditor_extraplugins}}extraPlugins: '{{$ckeditor_extraplugins}}',{{/if}}
                {{if $ckeditor_maxheight}}removePlugins: 'resize', autoGrow_maxHeight : "{{$ckeditor_maxheight}}",{{/if}}
                contentsCss : '{{$zBaseUrl}}/{{$ckeditor_style_editor}}',
                entities_greek: false, 
                entities_latin: false,
                {{if $useckfinder eq true}}
                filebrowserBrowseUrl : '{{$ckeditor_filemanagerpath}}/ckfinder.html',
                filebrowserImageBrowseUrl : '{{$ckeditor_filemanagerpath}}/ckfinder.html?Type=Images',
                filebrowserFilesBrowseUrl : '{{$ckeditor_filemanagerpath}}/ckfinder.html?Type=Files',
                filebrowserFlashBrowseUrl : '{{$ckeditor_filemanagerpath}}/ckfinder.html?Type=Flash',
                filebrowserUploadUrl : '{{$ckeditor_filemanagerpath}}/core/connector/php/connector.php?command=QuickUpload&type=Files',
                filebrowserImageUploadUrl : '{{$ckeditor_filemanagerpath}}/core/connector/php/connector.php?command=QuickUpload&type=Images',
                filebrowserFilesUploadUrl : '{{$ckeditor_filemanagerpath}}/core/connector/php/connector.php?command=QuickUpload&type=Files',
                filebrowserFlashUploadUrl : '{{$ckeditor_filemanagerpath}}/core/connector/php/connector.php?command=QuickUpload&type=Flash',
                {{/if}}
                {{if $usekcfinder eq true}}
                filebrowserBrowseUrl: '/{{$ckeditor_filemanagerpath}}/browse.php?type=files',
                filebrowserImageBrowseUrl: '/{{$ckeditor_filemanagerpath}}/browse.php?type=images',
                filebrowserFilesBrowseUrl: '/{{$ckeditor_filemanagerpath}}/browse.php?type=files',
                filebrowserFlashBrowseUrl: '/{{$ckeditor_filemanagerpath}}/browse.php?type=flash',
                {{/if}}
            });
        }
    }
    
{{else}}

    ckload = function () {
        {{foreach from=$modareas item=area}}
            {{if $area|strpos:':' gt 0}}{{assign var='colonpos' value=$area|strpos:':'}}{{else}}{{assign var='colonpos' value=0}}{{/if}}
            var {{$modname}}Editor = CKEDITOR.replace('{{$area|substr:0:$colonpos}}', {
                {{if $ckeditor_customconfigfile}}customConfig: '/{{$editors_path}}/{{$editor_dir}}/{{$ckeditor_customconfigfile}}',{{/if}}
                toolbar: "{{if $colonpos gt 0}}{{$area|substr:$colonpos+1}}{{else}}{{$ckeditor_barmode}}{{/if}}",
                skin: "{{$ckeditor_skin}}",
                {{if $ckeditor_language|strlen eq 2}}language: "{{$ckeditor_language}}",{{/if}}
                {{if $ckeditor_extraplugins}}extraPlugins: '{{$ckeditor_extraplugins}}',{{/if}}
                {{if $ckeditor_maxheight}}removePlugins: 'resize', autoGrow_maxHeight : "{{$ckeditor_maxheight}}",{{/if}}
                contentsCss : '{{$zBaseUrl}}/{{$ckeditor_style_editor}}',
                entities_greek: false,
                entities_latin: false,
                {{if $useckfinder eq true}}
                filebrowserBrowseUrl : '{{$ckeditor_filemanagerpath}}/ckfinder.html',
                filebrowserImageBrowseUrl : '{{$ckeditor_filemanagerpath}}/ckfinder.html?Type=Images',
                filebrowserFilesBrowseUrl : '{{$ckeditor_filemanagerpath}}/ckfinder.html?Type=Files',
                filebrowserFlashBrowseUrl : '{{$ckeditor_filemanagerpath}}/ckfinder.html?Type=Flash',
                filebrowserUploadUrl : '{{$ckeditor_filemanagerpath}}/core/connector/php/connector.php?command=QuickUpload&type=Files',
                filebrowserImageUploadUrl : '{{$ckeditor_filemanagerpath}}/core/connector/php/connector.php?command=QuickUpload&type=Images',
                filebrowserFilesUploadUrl : '{{$ckeditor_filemanagerpath}}/core/connector/php/connector.php?command=QuickUpload&type=Files',
                filebrowserFlashUploadUrl : '{{$ckeditor_filemanagerpath}}/core/connector/php/connector.php?command=QuickUpload&type=Flash',
                {{/if}}
                {{if $usekcfinder eq true}}
                filebrowserBrowseUrl: '/{{$ckeditor_filemanagerpath}}/browse.php?type=files',
                filebrowserImageBrowseUrl: '/{{$ckeditor_filemanagerpath}}/browse.php?type=images',
                filebrowserFilesBrowseUrl: '/{{$ckeditor_filemanagerpath}}/browse.php?type=files',
                filebrowserFlashBrowseUrl: '/{{$ckeditor_filemanagerpath}}/browse.php?type=flash',
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