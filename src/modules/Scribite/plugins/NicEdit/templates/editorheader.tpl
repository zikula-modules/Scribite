<!-- start Scribite with nicEdit for {$modname} -->
{pageaddvar name="javascript" value="modules/Scribite/plugins/NicEdit/vendor/nicedit/nicEdit_compressed.js"}
<script type="text/javascript">
/* <![CDATA[ */

{{if $modareas eq "all"}}
bkLib.onDomLoaded(function() {
    nicEditors.allTextAreas({
        iconsPath : '{{$baseurl}}modules/Scribite/plugins/NicEdit/vendor/nicedit/nicEditorIcons.gif', 
        BBCode : true,
        xhtml : {{if $xhtml eq true}}true{{else}}false{{/if}},
{{if $fullpanel eq true}}
        fullPanel : true
{{else}}
        buttonList : ['bold','italic','link','unlink','image','xhtml']
{{/if}}
    })
});
{{else}}
bkLib.onDomLoaded(function() {
    {{section name=modareas loop=$modareas}}
    new nicEditor({
        iconsPath : '{{$baseurl}}modules/Scribite/plugins/NicEdit/vendor/nicedit/nicEditorIcons.gif',
        xhtml : {{if $xhtml eq true}}true{{else}}false{{/if}},
{{if $fullpanel eq true}}
        fullPanel : true
{{else}}
        buttonList : ['bold','italic','link','unlink','image','xhtml']
{{/if}}
        }).panelInstance('{{$modareas[modareas]}}');
    {{/section}}
});
{{/if}}

/* ]]> */
</script>
<!-- end Scribite with nicEdit -->