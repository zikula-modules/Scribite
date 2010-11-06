{* $Id$ *}
{include file="scribite_admin_menu.htm"}

{if $jsquicktags}
<div class="z-warningmsg">
    <h2>{gt text='Warning'}</h2>
    <ul><li>{gt text='JS Quick Tags are activated.<br />For proper use you should deactivate this in Zikula Settings'}!</li></ul>
</div>
{/if}

<div class="z-admincontainer">
    <div class="z-adminpageicon">{img modname='Scribite' src='admin.gif' __alt="scribite!"} </div>
    <h2>scribite! - [skRi:bi:te:]</h2>

    <form class="z-form" action="{modurl modname="scribite" type="admin" func="updateconfig"}" method="post" enctype="application/x-www-form-urlencoded">
        <div>
            <input type="hidden" name="authid" value="{insert name='generateauthkey' module='Scribite'}" />
            <fieldset>
                <legend>{gt text="Editors"}</legend>
                <div class="z-formrow">
                    <label for="editors_path">{gt text="Editorpath"}</label>
                    <input id="editors_path" type="text" name="editors_path" size="40" maxlength="60" value="{$editors_path|safetext}" />
                </div>
                <div class="z-formrow">
                    <label for="DefaultEditor">{gt text="Default editor"}</label>
                    <select id="DefaultEditor" name="DefaultEditor">
                        {html_options options=$editor_list selected=$DefaultEditor}
                    </select>
                </div>
            </fieldset>

            <fieldset>
                <legend>{gt text="Modules"}</legend>
                <p><a style="margin: 1em 0;" class="z-icon-es-new" href="{modurl modname=scribite type=admin func=newmodule}">{gt text="Add module"}</a></p>
                <table class="z-admintable">
                    <thead>
                        <tr>
                            <th>{gt text="Module"}</th>
                            <th>{gt text="Editor"}</th>
                            <th class="z-right">{gt text="Options"}</th>
                        </tr>
                    </thead>
                    <tbody>
                        {section name=mid loop=$modconfig}
                        {modavailable modname=$modconfig[mid].modname assign="installed"}
                        {if $installed eq '1'}
                        <tr class="{cycle values="z-odd,z-even}">
                            <td>
                                <input id="modconfig_{$modconfig[mid].mid|safetext}_mid" type="hidden" name="modconfig[{$modconfig[mid].mid|safetext}][mid]" value="{$modconfig[mid].mid|safetext}" />
                                <input id="modconfig_{$modconfig[mid].mid|safetext}_modname" type="hidden" name="modconfig[{$modconfig[mid].mid|safetext}][modname]" value="{$modconfig[mid].modname|safetext}" />
                                <input id="modconfig_{$modconfig[mid].mid|safetext}_modfuncs" type="hidden" name="modconfig[{$modconfig[mid].mid|safetext}][modfuncs]" value="{$modconfig[mid].modfuncs|safetext}" />
                                <input id="modconfig_{$modconfig[mid].mid|safetext}_modareas" type="hidden" name="modconfig[{$modconfig[mid].mid|safetext}][modareas]" value="{$modconfig[mid].modareas|safetext}" />
                                <a href="{modurl modname=$modconfig[mid].modname type=admin}">{$modconfig[mid].modname|safetext}</a>
                            </td>
                            <td>
                                <select id="modconfig_{$modconfig[mid].mid|safetext}_modeditor" name="modconfig[{$modconfig[mid].mid|safetext}][modeditor]">
                                    {html_options options=$editor_list selected=$modconfig[mid].modeditor}
                                </select>
                            </td>
                            <td class="z-right">
                                <a href="{modurl modname=scribite type=admin func=modifymodule mid=$modconfig[mid].mid}">{img modname=core src=xedit.gif set=icons/extrasmall   __alt="edit module" __title="edit module"}</a>
                                <a href="{modurl modname=scribite type=admin func=delmodule mid=$modconfig[mid].mid}">{img modname=core src=14_layer_deletelayer.gif set=icons/extrasmall   __alt="delete module" __title="delete module"}</a>
                            </td>
                        </tr>
                        {/if}
                        {/section}
                    </tbody>
                </table>
            </fieldset>

            <div class="z-buttons z-formbuttons">
                {button src=button_ok.gif set=icons/extrasmall __alt="Save" __title="Save" __text="Save"}
                <a href="{modurl modname=scribite type=admin}">{img modname=core src=button_cancel.gif set=icons/extrasmall __alt="Cancel" __title="Cancel"} {gt text="Cancel"}</a>
            </div>
        </div>
    </form>
</div>
