<!-- start Scribite with nicEdit for {$modname} -->
{pageaddvar name="javascript" value="modules/Scribite/plugins/NicEdit/javascript/nicedit/nicEdit.js"}


<script type="text/javascript">
/* <![CDATA[ */

{{if $modareas eq "all"}}
    bkLib.onDomLoaded(function() {
    var editor_all = new nicEditor({iconsPath: '{{$zBaseUrl}}/modules/Scribite/plugins/NicEdit/javascript/nicedit/nicEditorIcons.gif', BBCode: true{{if $xhtml eq true}}, xhtml : true{{/if}}{{if $fullpanel eq true}}, fullPanel : true{{else}}, buttonList: ['bold','italic','link','unlink','image','xhtml'], {{/if}}}).allTextAreas;
    });
{{else}}
    bkLib.onDomLoaded(function() {
    {{section name=modareas loop=$modareas}}
    var editor_{{$modareas[modareas]}} = new nicEditor({iconsPath : '{{$zBaseUrl}}/modules/Scribite/plugins/NicEdit/javascript/nicedit/nicEditorIcons.gif'{{if $xhtml eq true}}, xhtml : true{{/if}}{{if $fullpanel eq true}}, fullPanel : true{{else}}, buttonList : ['bold','italic','link','unlink','image','xhtml'], {{/if}}}).panelInstance('{{$modareas[modareas]}}');
    {{/section}}
    });
{{/if}}

/* ]]> */
</script>
<!-- end Scribite with nicEdit -->