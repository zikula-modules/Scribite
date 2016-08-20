{adminheader}
{gt text='Image upload settings' assign='templateTitle'}
{pagesetvar name='title' value=$templateTitle}
<div class="z-admin-content-pagetitle">
    {icon type='config' size='small'}
    <h3>{$templateTitle}</h3>
</div>

{form cssClass='z-form'}
    {formvalidationsummary}

    <fieldset>
        <legend>{gt text='General settings'}</legend>

        <div class="z-formrow">
            {formlabel for='image_upload' __text='Enable image upload'}
            {formcheckbox id='image_upload'}
        </div>
        <div class="z-formrow">
            {formlabel for='upload_path' __text='URL to your uploads folder'}
            {formtextinput id='upload_path' size='40' maxLength='100'}
            <p class="z-formnote z-sub"><em>{gt text='e.g. userdata/Scribite'}</em></p>
        </div>

        <div class="z-buttons z-formbuttons">
            {formbutton class='z-bt-ok' commandName='save' __text='Save'}
        </div>
    </fieldset>
{/form}
{adminfooter}
