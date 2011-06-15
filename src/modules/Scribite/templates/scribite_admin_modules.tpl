{include file="scribite_admin_menu.tpl"}

<div class="z-admincontainer">
    <div class="z-adminpageicon">{img modname='Scribite' src='admin.gif' __alt="scribite!"} </div>
    <h2>{gt text='scribite! - [skRi:bi:te:]'}</h2>

    <table class="z-admintable">
        <thead>
            <tr>
                <th>{gt text="Module"}</th>
                <th>{gt text="Editor"}</th>
                <th>{gt text="Functions"}</th>
                <th>{gt text="TextAreas"}</th>
                <th class="z-right">{gt text="Options"}</th>
            </tr>
        </thead>
        <tbody>
            {section name=mid loop=$modconfig}
            {modavailable modname=$modconfig[mid].modname assign="installed"}
            {if $installed eq '1'}
            <tr class="{cycle values="z-odd,z-even}">
                <td>{$modconfig[mid].modname|safetext}</td>
                <td>{$modconfig[mid].modeditor|safetext}</td>
                <td>{$modconfig[mid].modfunclist|safetext}</td>
                <td>{$modconfig[mid].modarealist|safetext}</td>
                <td class="z-right">
                    <a href="{modurl modname='scribite' type='admin' func='modifymodule' mid=$modconfig[mid].mid}">{img modname='core' src='xedit.png' set='icons/extrasmall'   __alt="edit module" __title="edit module"}</a>
                    <a href="{modurl modname='scribite' type='admin' func='delmodule' mid=$modconfig[mid].mid}">{img modname='core' src='14_layer_deletelayer.png' set='icons/extrasmall'   __alt="delete module" __title="delete module"}</a>
                </td>
            </tr>
            {/if}
            {/section}
        </tbody>
    </table>

</div>
