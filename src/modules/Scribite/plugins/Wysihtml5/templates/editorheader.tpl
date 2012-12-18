<!-- start Scribite with Wysihtml5 for {$Scribite.modname} -->
{pageaddvar name="javascript" value="jquery"}
{pageaddvar name="javascript" value="modules/Scribite/plugins/Wysihtml5/vendor/wysihtml5-0.3.0.min.js"}
{pageaddvar name="javascript" value="modules/Scribite/plugins/Wysihtml5/vendor/parser_rules/simple.js"}

<script type="text/javascript">
    function addWysihtml5(textareaName) {
        // Insert editor header
        var toolbar = document.createElement("div");
        toolbar.id = 'toolbar_'+textareaName;
        toolbar.style = 'display: none';
        toolbar.innerHTML = '{{include file="file:modules/Scribite/plugins/Wysihtml5/templates/toolbar.tpl"}}';
        var textarea = document.getElementById(textareaName);
        var parentDiv = textarea.parentNode;
        parentDiv.insertBefore(toolbar, textarea);
        var editor = new wysihtml5.Editor(textareaName, {
            toolbar: 'toolbar_'+textareaName,
            parserRules: wysihtml5ParserRules
        });
    }

    window.onload = function() {
        var textareaList = document.getElementsByTagName('textarea');
        for(i = 0; i < textareaList.length; i++) {
            // check to make sure textarea not in disabled list or has 'noeditor' class
            if ((jQuery.inArray(textareaList[i].id, disabledTextareas) == -1) && !jQuery('#' + textareaList[i].id).hasClass('noeditor')) {
                // attach the editor
                addWysihtml5(textareaList[i].id);
            }
        }
    };
</script>
<!-- end Scribite with Wysihtml5 -->