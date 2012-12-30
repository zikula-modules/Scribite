<!-- start Scribite with Wysihtml5 for {$Scribite.modname} -->
{pageaddvar name="javascript" value="modules/Scribite/plugins/Wysihtml5/vendor/wysihtml5-0.3.0.min.js"}
{pageaddvar name="javascript" value="modules/Scribite/plugins/Wysihtml5/vendor/parser_rules/simple.js"}

<script type="text/javascript">
    function addWysihtml5(textareaName) {
        // Insert editor header
        var toolbar = document.createElement("div");
        toolbar.id = 'toolbar_'+textareaName;
        toolbar.style = 'display: none';
        toolbar.innerHTML = '{{include file="toolbar.tpl"}}';
        var textarea = document.getElementById(textareaName);
        var parentDiv = textarea.parentNode;
        parentDiv.insertBefore(toolbar, textarea);
        var editor = new wysihtml5.Editor(textareaName, {
            toolbar: 'toolbar_'+textareaName,
            parserRules: wysihtml5ParserRules
        });
    }

    var scribite_init = function() {
        var textareaList = document.getElementsByTagName('textarea');
        for(i = 0; i < textareaList.length; i++) {
            // check to make sure textarea not in disabled list or has 'noeditor' class
            // this editor does not use jQuery or prototype so reverting to manual JS - this may not work...
            if ((disabledTextareas.indexOf(textareaList[i].id) == -1) && !(textareaList[i].class == 'noeditor')) {
                // attach the editor
                addWysihtml5(textareaList[i].id);
                // notify subscriber
                insertNotifyInput(textareaList[i].id);
            }
        }
    };
    
    if (window.addEventListener) { // modern browsers
        window.addEventListener('load' , scribite_init, false);
    } else if (window.attachEvent) { // ie8 and even older browsers
        window.attachEvent('onload', scribite_init);
    } else { // fallback, not truly necessary
        window.onload = scribite_init;
    }
</script>
<!-- end Scribite with Wysihtml5 -->