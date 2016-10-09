{pageaddvarblock name='header'}
    <style type="text/css">
        #toolbar [data-wysihtml-action] {
            float: right;
        }
        
        #toolbar,
        textarea {
            width: 920px;
            padding: 5px;
            -webkit-box-sizing: border-box;
            -ms-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }
        
        textarea {
            height: 280px;
            border: 2px solid green;
            font-family: Verdana;
            font-size: 11px;
        }
        
        textarea:focus {
            color: black;
            border: 2px solid black;
        }
        
        .wysihtml-command-active {
            font-weight: bold;
        }
        
        [data-wysihtml-dialog] {
            margin: 5px 0 0;
            padding: 5px;
            border: 1px solid #666;
        }
        
        
        
        a[data-wysihtml-command-value="red"] {
            color: red;
        }
        
        a[data-wysihtml-command-value="green"] {
            color: green;
        }
        
        a[data-wysihtml-command-value="blue"] {
            color: blue;
        }
        
        .wysihtml-editor, .wysihtml-editor table td, .wysihtml-editor table th {
            outline: 1px dotted #abc;
            
        }
        
        code {
            background: #ddd;
            padding: 10px;
            white-space: pre;
            display: block;
            margin: 1em 0;
        }
        
        .toolbar {
            display: block;
            border-radius: 3px;
            border: 1px solid #fff;
            margin-bottom: 9px;
            line-height: 1em;
        }
        .toolbar a {
            display: inline-block;
            height: 1.5em;
            border-radius: 3px;
            font-size: 9px;
            line-height: 1.5em;
            text-decoration: none;
            background: #e1e1e1;
            border: 1px solid #ddd;
            padding: 0 0.2em;
            margin: 1px 0;
        }
        .toolbar a.wysihtml-command-active {
            background: #222;
            color: white;
        }
        .toolbar .block { 
            padding: 1px 1px;
            display: inline-block;
            background: #eee;
            border-radius: 3px;
            margin: 0px 1px 1px 0;
        }
        
        div[data-wysihtml-dialog="createTable"] {
            position: absolute;
            background: white;
        }
        
        div[data-wysihtml-dialog="createTable"] td {
            width: 10px; height: 5px;
            border: 1px solid #666;
        }
        
        .wysihtml-editor table td.wysiwyg-tmp-selected-cell, .wysihtml-editor table th.wysiwyg-tmp-selected-cell {
            outline: 2px solid green;
        }
    </style>
{/pageaddvarblock}
{strip}
<div class="toolbar">
    <div class="block">
        <a data-wysihtml-command="bold" title="{gt text='CTRL+B'}">{gt text='bold'}</a> |&nbsp;
        <a data-wysihtml-command="italic" title="{gt text='CTRL+I'}">{gt text='italic'}</a> |&nbsp;
        <a data-wysihtml-command="underline" title="{gt text='CTRL+U'}">{gt text='underline'}</a>
    </div>
    <div class="block">
        <a data-wysihtml-command="createLink">{gt text='link'}</a> |&nbsp;
        <a data-wysihtml-command="removeLink"><s>{gt text='link'}</s></a> |&nbsp;
        <a data-wysihtml-command="insertImage">{gt text='image'}</a> |&nbsp;
        <a data-wysihtml-command="formatBlock" data-wysihtml-command-value="h2">h2</a> |&nbsp;
        <a data-wysihtml-command="formatBlock" data-wysihtml-command-value="h3">h3</a> |&nbsp;
        <a data-wysihtml-command="formatBlock" data-wysihtml-command-value="p">p</a> |&nbsp;
        <a data-wysihtml-command="formatBlock" data-wysihtml-command-value="pre">pre</a> |&nbsp;
        <a data-wysihtml-command="formatBlock" data-wysihtml-command-blank-value="true">plaintext</a> |&nbsp;
        <a data-wysihtml-command="insertBlockQuote">{gt text='blockquote'}</a> |&nbsp;
        <a data-wysihtml-command="formatCode" data-wysihtml-command-value="language-html">{gt text='Code'}</a>
    </div>
    <div class="block">
        <a data-wysihtml-command="fontSizeStyle">{gt text='Size'}</a>
        <div data-wysihtml-dialog="fontSizeStyle" style="display: none">
          {gt text='Size'}:
          <input type="text" data-wysihtml-dialog-field="size" style="width: 60px" value="" />
          <a data-wysihtml-dialog-action="save">{gt text='OK'}</a>&nbsp;
          <a data-wysihtml-dialog-action="cancel">{gt text='Cancel'}</a>
        </div>
    </div>

    <div class="block">
        <a data-wysihtml-command="insertUnorderedList">&bull; {gt text='List'}</a> |&nbsp;
        <a data-wysihtml-command="insertOrderedList">1. {gt text='List'}</a> |&nbsp;
    </div>

    <div class="block">
        <a data-wysihtml-command="outdentList">&lt;-</a>
        <a data-wysihtml-command="indentList">-&gt;</a>
    </div>

    <div class="block">
        <a data-wysihtml-command="alignLeftStyle">{gt text='align left'}</a>
        <a data-wysihtml-command="alignRightStyle">{gt text='align right'}</a>
        <a data-wysihtml-command="alignCenterStyle">{gt text='align center'}</a>
    </div>

    <div class="block">
        <a data-wysihtml-command="foreColorStyle">{gt text='Color'}</a>
        <div data-wysihtml-dialog="foreColorStyle" style="display: none">
          {gt text='Color'}:
          <input type="text" data-wysihtml-dialog-field="color" value="rgba(0,0,0,1)" />
          <a data-wysihtml-dialog-action="save">{gt text='OK'}</a>&nbsp;
          <a data-wysihtml-dialog-action="cancel">{gt text='Cancel'}</a>
        </div>
    </div>

    <div class="block">
        <a data-wysihtml-command="bgColorStyle">{gt text='BG Color'}</a>
        <div data-wysihtml-dialog="bgColorStyle" style="display: none">
          {gt text='Color'}:
          <input type="text" data-wysihtml-dialog-field="color" value="rgba(0,0,0,1)" />
          <a data-wysihtml-dialog-action="save">{gt text='OK'}</a>&nbsp;
          <a data-wysihtml-dialog-action="cancel">{gt text='Cancel'}</a>
        </div>
    </div>

    <div class="block">
        <a data-wysihtml-command="undo">{gt text='undo'}</a>
        <a data-wysihtml-command="redo">{gt text='redo'}</a>
    </div>

    <!--div class="block">
        <a data-wysihtml-action="showSource">{gt text='HTML'}</a>
    </div-->

    <div class="block" data-wysihtml-hiddentools="table" style="display: none">
        <a data-wysihtml-command="mergeTableCells">{gt text='Merge'}</a>
        <a data-wysihtml-command="addTableCells" data-wysihtml-command-value="above">{gt text='row before'}</a>
        <a data-wysihtml-command="addTableCells" data-wysihtml-command-value="below">{gt text='row after'}</a>
        <a data-wysihtml-command="addTableCells" data-wysihtml-command-value="before">{gt text='col before'}</a>
        <a data-wysihtml-command="addTableCells" data-wysihtml-command-value="after">{gt text='col after'}</a>

        <a data-wysihtml-command="deleteTableCells" data-wysihtml-command-value="row">{gt text='delete row'}</a>
        <a data-wysihtml-command="deleteTableCells" data-wysihtml-command-value="column">{gt text='delete col'}</a>
    </div>

    <div data-wysihtml-dialog="createLink" style="display: none">
        <label>
          {gt text='Link'}:
          <input data-wysihtml-dialog-field="href" value="http://">
        </label>
        <a data-wysihtml-dialog-action="save">{gt text='OK'}</a>&nbsp;
        <a data-wysihtml-dialog-action="cancel">{gt text='Cancel'}</a>
    </div>
    <div data-wysihtml-dialog="insertImage" style="display: none">
        <label>
          {gt text='Image'}:
          <input data-wysihtml-dialog-field="src" value="http://">
        </label>
        <label>
          {gt text='Align'}:
          <select data-wysihtml-dialog-field="className">
            <option value="">{gt text='default'}</option>
            <option value="wysiwyg-float-left">{gt text='left'}</option>
            <option value="wysiwyg-float-right">{gt text='right'}</option>
          </select>
        </label>
        <a data-wysihtml-dialog-action="save">{gt text='OK'}</a>&nbsp;
        <a data-wysihtml-dialog-action="cancel">{gt text='Cancel'}</a>
    </div>
</div>
{/strip}
