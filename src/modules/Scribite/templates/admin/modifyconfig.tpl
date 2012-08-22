{adminheader}
<div class="z-admin-content-pagetitle">
    {icon type="config" size="small"}
    <h3>{gt text='Module config'}</h3>
</div>
<form class="z-form" action="{modurl modname="Scribite" type="admin" func="updateconfig"}" method="post" enctype="application/x-www-form-urlencoded">
    <div>
        <input type="hidden" name="csrftoken" value="{insert name="csrftoken"}" />
        <fieldset>
            <legend>{gt text="Editors"}</legend>
            <div class="z-formrow">
                <label for="DefaultEditor">{gt text="Default editor"}</label>
                <select id="DefaultEditor" name="DefaultEditor">
                    {html_options options=$editor_list selected=$modvars.Scribite.DefaultEditor}
                </select>

                <em class="z-formnote">
                    <a href="{modurl modname='Extensions' type='admin' func='viewPlugins' bymodule='Scribite'}">{gt text="Manage editors"}</a>
                </em>
            </div>
        </fieldset>

        <div class="z-buttons z-formbuttons">
            {button src='button_ok.png' set='icons/extrasmall' __alt="Save" __title="Save" __text="Save"}
            <a href="{modurl modname='Scribite' type='admin' func='modules'}">{img modname='core' src='button_cancel.png' set='icons/extrasmall' __alt="Cancel" __title="Cancel"} {gt text="Cancel"}</a>
        </div>
    </div>
</form>
{adminfooter}