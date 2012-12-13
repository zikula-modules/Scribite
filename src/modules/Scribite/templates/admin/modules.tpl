{ajaxheader ui=true}
{adminheader}

{pageaddvarblock}
<script type="text/javascript">
    document.observe("dom:loaded", function() {
        Zikula.UI.Tooltips($$('.tooltips'));
    });
</script>
{/pageaddvarblock}

<div class="z-admin-content-pagetitle">
    {icon type="view" size="small"}
    <h3>{gt text='Module list'}</h3>
</div>

<table class="z-admintable">
    <thead>
        <tr>
            <th>{gt text="Module"}</th>
            <th>{gt text="Editor"}</th>
            <th>{gt text="Functions"}</th>
            <th>{gt text="Textareas"}</th>
            <th class="z-nowrap z-right">{gt text="Options"}</th>
        </tr>
    </thead>
    <tbody>
        {foreach item="modconfig" from=$modconfigs}
        {modavailable modname=$modconfig.modname assign="installed"}
        {if $installed eq '1'}
        {modapifunc modname='Scribite' type="admin" func="getEditorTitle" editorname=$modconfig.modeditor assign="modeditortitle"}
        <tr class="{cycle values="z-odd,z-even"}">
            <td>{$modconfig.modname|safetext}</td>
            <td><span class="tooltips" title="{$modeditortitle}">{$modeditortitle}</span></td>
            <td>{$modconfig.modfuncs|@implode:","|safetext}</td>
            <td>{$modconfig.modareas|@implode:","|safetext}</td>
            <td class="z-nowrap z-right">
                <a href="{modurl modname='Scribite' type='admin' func='modifymodule' mid=$modconfig.mid}">{img modname='core' src='xedit.png' set='icons/extrasmall' __alt="Edit module" __title="Edit module" class="tooltips"}</a>
                <a href="{modurl modname='Scribite' type='admin' func='delmodule' mid=$modconfig.mid}">{img modname='core' src='14_layer_deletelayer.png' set='icons/extrasmall' __alt="Delete module" __title="Delete module" class="tooltips"}</a>
            </td>
        </tr>
        {/if}
        {/foreach}
    </tbody>
</table>
{adminfooter}