<!-- start Scribite with nicEdit for {$Scribite.modname} -->
{pageaddvar name="javascript" value="modules/Scribite/plugins/NicEdit/vendor/nicedit/nicEdit_compressed.js"}
<script type="text/javascript">
/* <![CDATA[ */

bkLib.onDomLoaded(function() {
    var params = {
        iconsPath : '{{$baseurl}}modules/Scribite/plugins/NicEdit/vendor/nicedit/nicEditorIcons.gif',
        xhtml : {{if $Scribite.editorVars.xhtml eq true}}true{{else}}false{{/if}},
        {{if $Scribite.editorVars.fullpanel eq true}}
        fullPanel : true
        {{else}}
        buttonList : ['bold','italic','link','unlink','image','xhtml']
        {{/if}}
        };
    var textareaList = document.getElementsByTagName('textarea');
    for(i = 0; i < textareaList.length; i++) {
        // check to make sure textarea not in disabled list or has 'noeditor' class
        // this editor does not use jQuery or prototype so reverting to manual JS - this may not work...
        if ((disabledTextareas.indexOf(textareaList[i].id) == -1) && !(textareaList[i].class == 'noeditor')) {
            // attach the editor
            var {{$Scribite.modname}}Editor = new nicEditor(params).panelInstance(textareaList[i].id);
            // notify subscriber
            insertNotifyInput(textareaList[i].id);
        }
    }
});

/* ]]> */
</script>
<!-- end Scribite with nicEdit -->