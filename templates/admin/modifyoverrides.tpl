{pageaddvar name='javascript' value='jquery-ui'}
{pageaddvar name='javascript' value='modules/Scribite/javascript/admin-modifyoverrides.js'}
{adminheader}
{gt text='Textarea/module overrides' assign='templateTitle'}
{pagesetvar name='title' value=$templateTitle}
<div class="z-admin-content-pagetitle">
    {icon type='config' size='small'}
    <h3>{$templateTitle}</h3>
</div>

<h3>{gt text='Module editor overrides'}</h3>
<p class="z-sub z-warningmsg">{gt text='Notice: entering values here will override the default values for the selected module only.'}</p>
<table id="module_table" class="z-datatable" style="margin-right:50%; width: 50%">
    <colgroup>
        <col id="cModule" />
        <col id="cEditor" />
        <col id="cActions" />
    </colgroup>
    <thead>
        <tr>
            <th id="hModule" scope="col">{gt text='Module'}</th>
            <th id="hEditor" scope="col">{gt text='Editor'}</th>
            <th id="hActions" scope="col">{gt text='Actions'}</th>
        </tr>
    </thead>
    <tbody>
    {counter start=0 assign='moduleOverridesCount'}
    {foreach key='module' item='override' from=$modvars.Scribite.overrides}
    {if isset($override.editor)}
        <tr>
            <td headers="hModule">
                <input type="text" name="override[{$module}]" id="module_{$module}" disabled="disabled" style="width: 99%" maxLength="50" value="{$module}" />
            </td>
            <td headers="hEditor">
                {html_options id="editor_`$module`" disabled='disabled' name='override[`$module`][editor]' options=$editorList selected=$override.editor}
            </td>
            <td headers="hActions">
                <a class="ajaxsubmit" style="display: none" id="modifyModuleOverride_{$module}" title="{gt text='modify'}" href="javascript:void(0);">{icon type='ok' size='extrasmall'}</a>
                <a class="ajaxsubmit" id="editModuleOverride_{$module}" title="{gt text='edit'}" href="javascript:void(0);">{icon type='edit' size='extrasmall'}</a>
                <a class="ajaxsubmit" id="deleteModuleOverride_{$module}" title="{gt text='delete'}" href="javascript:void(0);">{icon type='delete' size='extrasmall'}</a>
            </td>
        </tr>
        {counter}
    {/if}
    {/foreach}
    <tr id="moduleoverridesempty" class="z-center z-informationmsg"{if $moduleOverridesCount > 0} style="display: none"{/if}>
        <td colspan="3">{gt text='There are currently no module overrides. Add a new entry below.'}</td>
    </tr>
    {* this is a hidden row which contains new values and is made visible via jQuery *}
    <tr id="ai_moduleoverride" style="display: none">
        <td headers="hModule">
            <input type="text" id="ai_module" style="width: 99%" maxLength="50" value="" disabled="disabled" />
        </td>
        <td headers="hEditor">
            {html_options name='ai_editor' id='ai_editor' disabled='disabled' options=$editorList}
        </td>
        <td headers="hActions">
            <a class="ajaxsubmit" style="display: none" id="ai_modifyModuleOverride" title="{gt text='modify'}" href="javascript:void(0);">{icon type='ok' size='extrasmall'}</a>
            <a class="ajaxsubmit" id="ai_editModuleOverride" title="{gt text='edit'}" href="javascript:void(0);">{icon type='edit' size='extrasmall'}</a>
            <a class="ajaxsubmit" id="ai_deleteModuleOverride" title="{gt text='delete'}" href="javascript:void(0);">{icon type='delete' size='extrasmall'}</a>
        </td>
    </tr>
    {* this is a blank row for new additions *}
    <tr id="newmodule">
        <td headers="hModule">{html_options id='module_1' name='override[0][module]' options=$moduleList}</td>
        <td headers="hEditor">{html_options id='editor_1' name='override[0][editor]' options=$editorList}</td>
        <td headers="hActions">
            <a class="ajaxsubmit" id="submitModuleOverride_1" title="{gt text='submit'}" href="javascript:void(0);">{icon type='ok' size='extrasmall'}</a>
        </td>
    </tr>
    </tbody>
</table>

<h3>{gt text='Textarea overrides'}</h3>
<p class="z-sub z-warningmsg">{gt text="Enter only <strong>one</strong> Textarea DOM ID per row, or enter 'all' to configure all textareas."}<br />
{gt text="Disabling a textarea means no scribite editor will be loaded for the specificed textarea. (You cannot disable 'all' textareas.)"}<br />
{gt text='Currently only CKEditor and TinyMCE support parameter overrides.'}<br />
{gt text='Enter template parameters as comma-separated, name:value pairs (with colon).'}</p>
<table id="textarea_table" class="z-datatable">
    <colgroup>
        <col id="cTextModule" />
        <col id="cTextArea" />
        <col id="cTextDisabled" />
        <col id="cTextParameters" />
        <col id="cTextActions" />
    </colgroup>
    <thead>
        <tr>
            <th id="hTextModule" scope="col" class="z-w15">{gt text='Module'}</th>
            <th id="hTextArea" scope="col" class="z-w25">{gt text='Textarea DOM ID'}</th>
            <th id="hTextDisabled" scope="col" class="z-w05">{gt text='disabled'}</th>
            <th id="hTextParameters" scope="col" class="z-w45">{gt text='Plugin template parameters'}</th>
            <th id="hTextActions" scope="col" class="z-w10">{gt text='Actions'}</th>
        </tr>
    </thead>
    <tbody>
    <tr>
        <td headers="hTextModule"></td>
        <td headers="hTextArea" class="z-sub"><em>{gt text="example: 'hometext' or 'all'"}</em></td>
        <td headers="hTextDisabled" class="z-sub"><em>{gt text='this'}</em></td>
        <td headers="hTextParameters" class="z-sub"><em>{gt text="example: 'toolbar:Basic,uiColor:#0099FF' or leave empty"}</em></td>
        <td headers="hTextActions" class='z-sub'></td>
    </tr>
    {counter start=0 assign='textareaOverridesCount'}
    {foreach key='module' item='override' from=$modvars.Scribite.overrides}
    {foreach key='textarea' item='settings' from=$override}
    {if ($textarea != "editor") && ($textarea != '')}
        <tr>
            <td headers="hTextModule">
                <input type="text" name="override[{$module}]" id="module_{$module}{$textarea}" disabled="disabled" style="width: 99%" maxLength="50" value="{$module}" />
            </td>
            <td headers="hTextArea">
                <input type="text" name="override[{$module}][textarea]" id="area_{$module}{$textarea}" disabled="disabled" style="width: 99%" maxLength="50" value="{$textarea}" />
            </td>
            <td headers="hTextDisabled">
                <input type="checkbox" name="override[{$module}][disabled]" id="disabled_{$module}{$textarea}"{if $settings.disabled == 'true'} checked="checked"{/if} disabled="disabled" />
            </td>
            <td headers="hTextParameters">
                <input name="override[{$module}][params]" id="params_{$module}{$textarea}" disabled="disabled" style="width: 99%" maxLength="100" value="{implodeparams params=$settings.params}" />
            </td>
            <td headers="hTextActions">
                <a class="ajaxsubmit" style="display: none" id="modifyTextareaOverride_{$module}{$textarea}" title="{gt text='modify'}" href="javascript:void(0);">{icon type='ok' size='extrasmall'}</a>
                <a class="ajaxsubmit" id="editTextareaOverride_{$module}{$textarea}" title="{gt text='edit'}" href="javascript:void(0);">{icon type='edit' size='extrasmall'}</a>
                <a class="ajaxsubmit" id="deleteTextareaOverride_{$module}{$textarea}" title="{gt text='delete'}" href="javascript:void(0);">{icon type='delete' size='extrasmall'}</a>
            </td>
        </tr>
        {counter}
    {/if}
    {/foreach}
    {/foreach}
    <tr id="textareaoverridesempty" class="z-center z-informationmsg"{if $textareaOverridesCount > 0} style="display: none"{/if}>
        <td colspan="5">{gt text='There are currently no textarea overrides. Add a new entry below.'}</td>
    </tr>
    {* this is a hidden row which contains new values and is made visible via jQuery *}
    <tr id="ai_textareaoverride" style="display: none">
        <td headers="hTextModule"><input type="text" id="ai_module" style="width: 99%" maxLength="50" value="" disabled="disabled" /></td>
        <td headers="hTextArea"><input type="text" id="ai_area" style="width: 99%" maxLength="50" value="" disabled="disabled" /></td>
        <td headers="hTextDisabled"><input type="checkbox" id="ai_disabled" disabled="disabled" /></td>
        <td headers="hTextParameters"><input type="text" id="ai_params" style="width: 99%" maxLength="100" value="" disabled="disabled" /></td>
        <td headers="hTextActions">
            <a class='ajaxsubmit' style='display:none;' id='ai_modifyTextareaOverride' title='{gt text="modify"}' href='javascript:void(0);'>{icon type="ok" size="extrasmall"}</a>
            <a class='ajaxsubmit' id='ai_editTextareaOverride' title='{gt text="edit"}' href='javascript:void(0);'>{icon type="edit" size="extrasmall"}</a>
            <a class='ajaxsubmit' id='ai_deleteTextareaOverride' title='{gt text="delete"}' href='javascript:void(0);'>{icon type="delete" size="extrasmall"}</a>
        </td>
    </tr>
    {* this is a blank row for new additions *}
    <tr id="newtextarea">
        <td headers="hTextModule">{html_options id='module_0' name='override[0][module]' options=$moduleList}</td>
        <td headers="hTextArea"><input type="text" name="override[0][textarea]" id="area_0" style="width: 99%" maxLength="50" /></td>
        <td headers="hTextDisabled"><input type="checkbox" name="override[0][disabled]" id="disabled_0" /></td>
        <td headers="hTextParameters"><input type="text" name="override[0][params]" id="params_0" style="width: 99%" maxLength="100" /></td>
        <td headers="hTextActions">
            <a class="ajaxsubmit" id="submitTextareaOverride_0" title="{gt text='submit'}" href="javascript:void(0);">{icon type='ok' size='extrasmall'}</a>
        </td>
    </tr>
    </tbody>
</table>
{adminfooter}
