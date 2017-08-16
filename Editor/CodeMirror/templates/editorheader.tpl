<!-- start Scribite with CodeMirror for {$Scribite.modname} -->
{pageaddvar name='javascript' value='jquery'}
{pageaddvar name='stylesheet' value='modules/Scribite/plugins/CodeMirror/style/style.css'}
{pageaddvar name='javascript' value='modules/Scribite/plugins/CodeMirror/vendor/CodeMirror/lib/codemirror.js'}
{pageaddvar name='stylesheet' value='modules/Scribite/plugins/CodeMirror/vendor/CodeMirror/lib/codemirror.css'}
{pageaddvar name='javascript' value="modules/Scribite/plugins/CodeMirror/vendor/CodeMirror/mode/`$Scribite.editorVars.editorMode`/`$Scribite.editorVars.editorMode`.js"}
{pageaddvar name='javascript' value='modules/Scribite/plugins/CodeMirror/javascript/CodeMirror.ajaxApi.js'}
{if isset($Scribite.editorVars.themes) && $Scribite.editorVars.themes != ''}
    {foreach item='theme' from=$Scribite.editorVars.themes}
        {pageaddvar name='stylesheet' value="modules/Scribite/plugins/CodeMirror/vendor/CodeMirror/theme/`$theme`.css"}
    {/foreach}
{/if}

<script type="text/javascript">
/* <![CDATA[ */
    // instantiate Scribite object for editor creation and ajax manipulation
    var editorOptions = {
        lineNumbers: {{if $Scribite.editorVars.showLineNumbers eq true}}true{{else}}false{{/if}},
        lineWrapping: {{if $Scribite.editorVars.lineWrapping eq true}}true{{else}}false{{/if}},
        mode: '{{$Scribite.editorVars.editorMode}}',
        theme: '{{' '|implode:$Scribite.editorVars.themes}}',
        indentUnit: 4
    };

    (function($) {
        $(document).ready(function() {
            // instantiate Scribite object for editor creation and ajax manipulation
            Scribite = new ScribiteUtil();
            Scribite.createEditors();
        });
    })(jQuery)
/* ]]> */
</script>
<!-- end Scribite with CodeMirror for {$Scribite.modname} -->
