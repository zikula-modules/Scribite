{adminheader}
{gt text='CodeMirror configuration' assign='templateTitle'}
{pagesetvar name='title' value=$templateTitle}
<div class="z-admin-content-pagetitle">
    <img src="{$baseurl}modules/Scribite/plugins/CodeMirror/images/logo.png" alt="CodeMirror" height="22" />
    <h3>{$templateTitle}</h3>
</div>

{form cssClass='z-form'}
    {formvalidationsummary}
    <fieldset>
        <legend>{gt text='General settings'}</legend>
        <div class="z-formrow">
            {formlabel for='showLineNumbers' __text='Show line numbers'}
            {formcheckbox id='showLineNumbers'}
        </div>
        <div class="z-formrow">
            {formlabel for='lineWrapping' __text='Wrap long lines (instead of scrolling)'}
            {formcheckbox id='lineWrapping'}
        </div>
    </fieldset>
    <fieldset>
        <legend>{gt text='Editor modes'}</legend>
        <div class="z-formrow">
            {formlabel for='editorMode' __text='Modes'}
            {formdropdownlist id='editorMode' items=$editorModeItems}
        </div>
    </fieldset>
    <fieldset>
        <legend>{gt text='Themes'}</legend>
        <div class="z-formrow">
            {formlabel for='themes' __text='Themes'}
            {formcheckboxlist id='themes' items=$themesItems repeatColumns=2}
        </div>
    </fieldset>

    <div class="z-buttons z-formbuttons">
        {formbutton class='z-bt-ok' commandName='save' __text='Save'}
        {formbutton class='z-bt-archive' commandName='restore' __text='Restore defaults'}
        {formbutton class='z-bt-cancel' commandName='cancel' __text='Cancel'}
    </div>
{/form}
{adminfooter}
