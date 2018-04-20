{adminheader}
{gt text='Module settings' assign='templateTitle'}
{pagesetvar name='title' value=$templateTitle}
<div class="z-admin-content-pagetitle">
    {icon type='config' size='small'}
    <h3>{$templateTitle}</h3>
</div>
{form cssClass='z-form'}
    {formvalidationsummary}
    <fieldset>
        <legend>{gt text='Editor'}</legend>
        <div class="z-formrow">
            {formlabel for='DefaultEditor' __text='Default editor'}
            {formdropdownlist id='DefaultEditor' items=$editor_list}
            <em class="z-formnote">
                <a href="{modurl modname='Extensions' type='admin' func='viewPlugins' bymodule='Scribite'}">{gt text='Manage editors'}</a>
            </em>
        </div>
        <div class="z-formrow">
            {formlabel for='UploadDirectory' __text='Upload directory'}
             {formtextinput id='UploadDirectory' maxLength='1000' text='userdata/uploads'}
            <em class="z-formnote">
                {gt text='Place to store files from editors with upload functionality, like userdata/uploads. Make sure to have HTTP access to include in editor window.'}
            </em>
        </div>
    </fieldset>
    <fieldset>
        <legend>{gt text='Security settings'}</legend>
        <p>{gt text='If you embed media (like YouTube and Vimeo videos) and experience problems with their display, you need to change some security settings (allowed html tags as well as html purifier configuration). You can easily click the link below to do that.'}</p>
        <p><a href="{modurl modname='Scribite' type='admin' func='allowEmbeddedMedia'}" title="{gt text='Update security settings to allow display of embedded media'}">{gt text='Update settings for embedded media display'}</a></p>
        <p><em><strong>{gt text='Warning'}:</strong> {gt text='changing these settings makes your system more vulnerable for XSS attacks. Do this only if you really trust your editors.'}</em></p>
    </fieldset>

    <div class="z-buttons z-formbuttons">
        {formbutton class="z-bt-ok" commandName='save' __text='Save'}
        {formbutton class="z-bt-cancel" commandName='cancel' __text='Cancel'}
    </div>
{/form}
{adminfooter}
