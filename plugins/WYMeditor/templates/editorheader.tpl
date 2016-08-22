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
    // instantiate Scribite object for editor creation and ajax manipulation
    var selectedSkin = '{{$Scribite.editorVars.skin}}';
    var activePlugins = [{{if isset($Scribite.editorVars.activeplugins) && $Scribite.editorVars.activeplugins != ''}}{{foreach name='pluginLoop' item='plugin' from=$Scribite.editorVars.activeplugins}}'{{$plugin}}'{{if !$smarty.foreach.pluginLoop.last}}, {{/if}}{{/foreach}}{{/if}}];
    Scribite = new ScribiteUtil();

    if (window.addEventListener) { // modern browsers
        window.addEventListener('load', Scribite.createEditors, false);
    } else if (window.attachEvent) { // ie8 and even older browsers
        window.attachEvent('onload', Scribite.createEditors);
    } else { // fallback, not truly necessary
        window.onload = Scribite.createEditors;
    }
/* ]]> */
</script>
<!-- end Scribite with WYMeditor for {$Scribite.modname} -->
