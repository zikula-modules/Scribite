{adminheader}<div class="z-admin-content-pagetitle">    <img src="{$baseurl}modules/Scribite/plugins/NicEdit/images/logo.png" height='22'>    <h3>{gt text='NicEdit configuration'}</h3></div>{form cssClass="z-form"}    {formvalidationsummary}    <fieldset>        <legend>{gt text='Settings'}</legend>        <div class="z-formrow">            {formlabel for="fullpanel" __text="Full toolbar"}            {formcheckbox id="fullpanel"}        </div>        <div class="z-formrow">            {formlabel for="xhtml" __text="XHTML (experimental)"}            {formcheckbox id="xhtml"}        </div>    </fieldset>    <div class="z-buttons z-formbuttons">        {formbutton class="z-bt-ok" commandName="save" __text="Save"}        {formbutton class="z-bt-cancel" commandName="cancel" __text="Cancel"}    </div>{/form}{adminfooter}