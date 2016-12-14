<!-- start Scribite with Aloha for {$Scribite.modname} -->
{pageaddvar name='javascript' value='modules/Scribite/plugins/Aloha/vendor/aloha/lib/require.js'}
{pageaddvar name='javascript' value='jquery'}
{pageaddvar name='stylesheet' value='modules/Scribite/plugins/Aloha/vendor/aloha/css/aloha.css'}
{pageaddvar name='javascript' value='modules/Scribite/plugins/Aloha/javascript/Aloha.ajaxApi.js'}

<!-- load the Aloha Editor core and some plugins -->
<script src="{$baseurl}modules/Scribite/plugins/Aloha/vendor/aloha/lib/aloha.js"
        data-aloha-plugins="common/ui{if isset($Scribite.editorVars.commonPlugins) && $Scribite.editorVars.commonPlugins != ''}{foreach item='plugin' from=$Scribite.editorVars.commonPlugins},common/{$plugin}{/foreach}{/if}{if isset($Scribite.editorVars.extraPlugins) && $Scribite.editorVars.extraPlugins != ''}{foreach item='plugin' from=$Scribite.editorVars.extraPlugins},extra/{$plugin}{/foreach}{/if}">
</script>

<script type="text/javascript">
/* <![CDATA[ */
    (function($) {
        $(document).ready(function() {
            // instantiate Scribite object for editor creation and ajax manipulation
            Scribite = new ScribiteUtil();
            Scribite.createEditors();
        });
    })(jQuery)
 /* ]]> */
</script>
<!-- end Scribite with Aloha for {$Scribite.modname} -->
