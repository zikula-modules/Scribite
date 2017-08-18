<!-- start Scribite with WYMeditor for {$Scribite.modname} -->
{pageaddvar name='javascript' value='jquery'}
{pageaddvar name='stylesheet' value=$Scribite.editorVars.style}
{pageaddvar name='stylesheet' value="modules/Scribite/plugins/WYMeditor/vendor/wymeditor/skins/`$Scribite.editorVars.skin`/skin.css"}
{pageaddvar name='javascript' value='modules/Scribite/plugins/WYMeditor/vendor/wymeditor/jquery.wymeditor.min.js'}
{pageaddvar name='javascript' value='modules/Scribite/plugins/WYMeditor/javascript/WYMeditor.ajaxApi.js'}
{if isset($Scribite.editorVars.activeplugins) && $Scribite.editorVars.activeplugins != ''}
    {foreach item='plugin' from=$Scribite.editorVars.activeplugins}
        {pageaddvar name='javascript' value="modules/Scribite/plugins/WYMeditor/vendor/wymeditor/plugins/`$plugin`/jquery.wymeditor.`$plugin`.js"}
    {/foreach}
{/if}

<script type="text/javascript">
/* <![CDATA[ */
    var selectedSkin = '{{$Scribite.editorVars.skin}}';
    var activePlugins = [{{if isset($Scribite.editorVars.activeplugins) && $Scribite.editorVars.activeplugins != ''}}{{foreach name='pluginLoop' item='plugin' from=$Scribite.editorVars.activeplugins}}'{{$plugin}}'{{if !$smarty.foreach.pluginLoop.last}}, {{/if}}{{/foreach}}{{/if}}];

    (function($) {
        $(document).ready(function() {
            // instantiate Scribite object for editor creation and ajax manipulation
            Scribite = new ScribiteUtil();
            Scribite.createEditors();
        });
    })(jQuery)
/* ]]> */
</script>
<!-- end Scribite with WYMeditor for {$Scribite.modname} -->
