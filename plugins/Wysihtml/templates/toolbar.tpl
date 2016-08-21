{strip}
    <a data-wysihtml5-command="bold" title="{gt text='CTRL+B'}">{gt text='bold'}</a> |&nbsp;
    <a data-wysihtml5-command="italic" title="{gt text='CTRL+I'}">{gt text='italic'}</a> |&nbsp;
    <a data-wysihtml5-command="createLink">{gt text='link'}</a> |&nbsp;
    <a data-wysihtml5-command="insertImage">{gt text='image'}</a> |&nbsp;
    <a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h2">h2</a> |&nbsp;
    <a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h3">h3</a> |&nbsp;
    <a data-wysihtml5-command="insertUnorderedList">{gt text='list'}</a> |&nbsp;
    {* <a data-wysihtml5-command="insertOrderedList">insertOrderedList</a> |&nbsp; *}
    <a data-wysihtml-action="change_view">{gt text='switch to html view'}</a>

    <div data-wysihtml-dialog="createLink" style="display: none">
        <label>
            {gt text='Link:'}
            <input data-wysihtml-dialog-field="href" value="http://" />
        </label>
        <a data-wysihtml-dialog-action="save">{gt text='OK'}</a>&nbsp;
        <a data-wysihtml-dialog-action="cancel">{gt text='Cancel'}</a>
    </div>
    
    <div data-wysihtml-dialog="insertImage" style="display: none">
        <label>
            {gt text='Image:'}
            <input data-wysihtml-dialog-field="src" value="http://" />
        </label>
        <label>
            {gt text='Align:'}
            <select data-wysihtml-dialog-field="className">
            <option value="">{gt text='default'}</option>
            <option value="wysiwyg-float-left">{gt text='left'}</option>
            <option value="wysiwyg-float-right">{gt text='right'}</option>
            </select>
        </label>
        <a data-wysihtml-dialog-action="save">{gt text='OK'}</a>&nbsp;
        <a data-wysihtml-dialog-action="cancel">{gt text='Cancel'}</a>
    </div>
{/strip}
