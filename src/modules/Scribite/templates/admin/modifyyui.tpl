{adminheader}<div class="z-admin-content-pagetitle">    <img src="{$baseurl}modules/Scribite/lib/Scribite/Editor/YUI/logo.png" height='22'>    <h3>{gt text='YUI Rich Text Editor configuration'}</h3></div>{form cssClass="z-form"}    {formvalidationsummary}    <fieldset>        <legend>{gt text='Settings'}</legend>        <div class="z-formrow">            {formlabel for="yui_type" __text="Toolbar"}            {formdropdownlist id="yui_type" items=$yui_types}        </div>        <div class="z-formrow">            {formlabel __text="Editor width and height"}            <div>                {formtextinput id="yui_width" size="5" maxLength="6" text="auto"}                {formlabel for="yui_width" __text="px/(auto)"}                {formtextinput id="yui_height" size="5" maxLength="6" text="auto"}                {formlabel for="yui_height" __text="px/(auto)"}            </div>        </div>        <div class="z-formrow">            {formlabel for="yui_dombar" __text="Statusbar"}            {formcheckbox id="yui_dombar"}        </div>        <div class="z-formrow">            {formlabel for="yui_animate" __text="Animation"}            {formcheckbox id="yui_animate"}        </div>        <div class="z-formrow">            {formlabel for="yui_collapse" __text="Collapsable"}            {formcheckbox id="yui_collapse"}        </div>    </fieldset>    <div class="z-buttons z-formbuttons">        {formbutton class="z-bt-ok" commandName="save" __text="Save"}        {formbutton class="z-bt-cancel" commandName="cancel" __text="Cancel"}    </div>{/form}{adminfooter}