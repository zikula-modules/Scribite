{* $Id$ *}
{include file="scribite_admin_menu.tpl"}
<div class="z-admincontainer">
    <div class="z-adminpageicon">{img modname=core src=package.gif set=icons/large}</div>
    <h2>{gt text="Edit module: %s" tag1=$modulename|safetext}</h2>
    <form class="z-form" action="{modurl modname="scribite" type="admin" func="updatemodule"}" method="post" enctype="application/x-www-form-urlencoded">
        <div>
            <input type="hidden" name="authid" value="{insert name='generateauthkey' module='Scribite'}" />
            <input id="mid" type="hidden" name="mid" value="{$mid}" />
            <input id="modulename" type="hidden" name="modulename" size="25" maxlength="25" value="{$modulename|safetext}" readonly="readonly" />
            <fieldset>
                <legend>{$modulename|safetext}</legend>
                <div class="z-formrow">
                    <label for="modfuncs">{gt text="module functions (comma separated, \"all \" for all funcs)"}</label>
                    <input id="modfuncs" type="text" name="modfuncs" size="50" maxlength="100" value="{$modfuncs|safetext}" />
                </div>
                <div class="z-formrow">
                    <label for="modareas">{gt text="textarea-ID's (comma separated, \"all\" for all areas)"}</label>
                    <input id="modareas" type="text" name="modareas" size="50" maxlength="50" value="{$modareas|safetext}" />
                </div>
                <div class="z-formrow">
                    <label for="modeditor">{gt text="editor"}</label>
                    <select id="modeditor" name="modeditor">
                        {html_options options=$editor_list selected=$modeditor}
                    </select>
                </div>
            </fieldset>
            <div class="z-buttons z-formbuttons">
                {button src=button_ok.gif set=icons/extrasmall __alt="Save" __title="Save" __text="Save"}
                <a href="{modurl modname=scribite type=admin}">{img modname=core src=button_cancel.gif set=icons/extrasmall __alt="Cancel" __title="Cancel"} {gt text="Cancel"}</a>
            </div>
        </div>
    </form>
</div>
