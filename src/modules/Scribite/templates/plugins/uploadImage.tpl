<br /><br />
<form class="z-gap z-form" enctype="multipart/form-data" action="{modurl modname='Scribite' type='user' func='uploadImage'}" method="post">
    <fieldset>
        <legend>{gt text='Upload'}</legend>
        <div class="z-formrow">
            <label for="file">{gt text='Upload image:'}</label>
            <input id='file' name="file" type="file" />
        </div>

        <div class="z-formbuttons z-buttons">
            {button src='button_ok.png' set='icons/extrasmall' __alt='Upload' __title='Upload' __text='Upload'}
        </div>
    </fieldset>

</form>