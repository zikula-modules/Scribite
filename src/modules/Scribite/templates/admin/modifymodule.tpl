{adminheader}
<div class="z-admin-content-pagetitle">
    {icon type="edit" size="small"}
    {if empty($modname)}
        <h3>{gt text="Add module"}</h3>
    {else}
    <h3>{gt text="Edit module: %s" tag1=$modname|safetext}</h3>
    {/if}

</div>

{form cssClass="z-form"}
{formvalidationsummary}

        <fieldset>
            <div class="z-formrow">
            {formlabel for="modname" __text="Module name"}
                {if empty($modname)}
                {formdropdownlist id="modname" items=$allModules}
                {else}
                {formtextinput id="modname" maxLength="64" readOnly="true"}
                {/if}
            </div>

            <div class="z-formrow">
                {formlabel for="modfuncs" __text="Module functions"}
                {formtextinput id="modfuncs" size="50" maxLength="100"}
                <em class="z-formnote z-sub">{gt text="(comma separated, 'all' for all funcs)"}</em>
            </div>
            <div class="z-formrow">
                {formlabel for="modareas" __text="Textarea-ID's"}
                {formtextinput id="modareas" size="50" maxLength="50"}
                <em class="z-formnote z-sub">{gt text="(comma separated, 'all' for all funcs)"}</em>
            </div>
            <div class="z-formrow">
                {formlabel for="modeditor" __text="Editor"}
                {formdropdownlist id="modeditor" items=$editor_list}
            </div>
        </fieldset>
        <div class="z-buttons z-formbuttons">
            {formbutton class="z-bt-ok" commandName="save" __text="Save"}
            {formbutton class="z-bt-cancel" commandName="cancel" __text="Cancel"}
        </div>
{/form}
{adminfooter}
