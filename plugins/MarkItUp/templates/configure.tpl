{adminheader}
{gt text='markItUp! configuration' assign='templateTitle'}
{pagesetvar name='title' value=$templateTitle}
<div class="z-admin-content-pagetitle">
    <img src="{$baseurl}modules/Scribite/plugins/MarkItUp/images/logo.jpg" alt="markItUp!" height="22" />
    <h3>{$templateTitle}</h3>
</div>

{form cssClass='z-form'}
    {formvalidationsummary}
    <fieldset>
        <legend>{gt text='Settings'}</legend>
        <div class="z-formrow">
            {formlabel for='width' __text='Editor width'}
            {formtextinput id='width' size='5' maxLength='6' text='auto'}
            <em class="z-formnote z-sub">{gt text='%/px/auto, e.g. 99% or 400px or auto'}</em>
        </div>
        <div class="z-formrow">
            {formlabel for='height' __text='Editor height'}
            {formtextinput id='height' size='5' maxLength='6'}
            <em class="z-formnote z-sub">{gt text='%/px/auto, e.g. 99% or 400px or auto'}</em>
        </div>
    </fieldset>

    <div class="z-buttons z-formbuttons">
        {formbutton class='z-bt-ok' commandName='save' __text='Save'}
        {formbutton class='z-bt-archive' commandName='restore' __text='Restore defaults'}
        {formbutton class='z-bt-cancel' commandName='cancel' __text='Cancel'}
    </div>
{/form}
{adminfooter}
