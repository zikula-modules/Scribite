<!-- start Scribite with nicEdit for {$Scribite.modname} -->
{pageaddvar name="javascript" value="modules/Scribite/plugins/NicEdit/vendor/nicedit/nicEdit_compressed.js"}
<script type="text/javascript">
/* <![CDATA[ */

{{if $Scribite.modareas eq "all"}}
bkLib.onDomLoaded(function() {
    nicEditors.allTextAreas({
        iconsPath : '{{$baseurl}}modules/Scribite/plugins/NicEdit/vendor/nicedit/nicEditorIcons.gif', 
        BBCode : true,
        xhtml : {{if $Scribite.editorVars.xhtml eq true}}true{{else}}false{{/if}},
{{if $Scribite.editorVars.fullpanel eq true}}
        fullPanel : true
{{else}}
        buttonList : ['bold','italic','link','unlink','image','xhtml']
{{/if}}
    })
});
{{else}}
bkLib.onDomLoaded(function() {
    {{foreach from=$Scribite.modareas item='modarea'}}
    new nicEditor({
        iconsPath : '{{$baseurl}}modules/Scribite/plugins/NicEdit/vendor/nicedit/nicEditorIcons.gif',
        xhtml : {{if $Scribite.editorVars.xhtml eq true}}true{{else}}false{{/if}},
{{if $Scribite.editorVars.fullpanel eq true}}
        fullPanel : true
{{else}}
        buttonList : ['bold','italic','link','unlink','image','xhtml']
{{/if}}
        }).panelInstance('{{$modarea}}');
    {{/foreach}}
});
{{/if}}

/* ]]> */
</script>
<!-- end Scribite with nicEdit -->