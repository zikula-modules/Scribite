<!-- start Scribite with Wysihtml5 for {$modname} -->
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
            toolbar:      'toolbar_'+textareaName,
            parserRules:  wysihtml5ParserRules
        });

    }

    window.onload = function() {

        {{if $modareas eq "all"}}
            var textareas = document.getElementsByTagName('textarea');
            var i = textareas.length; while( i-- ) {
                addWysihtml5(textareas[i].id);
            }
        {{else}}
        {{foreach from=$modareas item=area}}
            addWysihtml5('text');
        {{/foreach}}
        {{/if}}

    };

</script>


<!-- end Scribite with Wysihtml5 -->