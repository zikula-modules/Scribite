<!-- start Scribite with YUI Rich Text Editor for {$modname} -->
{pageaddvar name="stylesheet" value="modules/Scribite/plugins/YUI/style/style.css"}
{pageaddvar name="javascript" value="prototype"}

{if $type == 'Simple'}
    {* load scripts for YUI simple mode *}
    {pageaddvar name="stylesheet" value="http://yui.yahooapis.com/2.9.0/build/assets/skins/sam/skin.css"}
    {pageaddvar name="javascript" value="http://yui.yahooapis.com/2.9.0/build/yahoo-dom-event/yahoo-dom-event.js"}
    {pageaddvar name="javascript" value="http://yui.yahooapis.com/2.9.0/build/element/element-min.js"}
    {pageaddvar name="javascript" value="http://yui.yahooapis.com/2.9.0/build/container/container_core-min.js"}
    {pageaddvar name="javascript" value="http://yui.yahooapis.com/2.9.0/build/editor/simpleeditor-min.js"}
{else}
    {* load scripts for YUI Rich Text Editor full mode *}
    {pageaddvar name="stylesheet" value="http://yui.yahooapis.com/2.9.0/build/assets/skins/sam/skin.css"}
    {pageaddvar name="javascript" value="http://yui.yahooapis.com/2.9.0/build/yahoo-dom-event/yahoo-dom-event.js"}
    {pageaddvar name="javascript" value="http://yui.yahooapis.com/2.9.0/build/element/element-min.js"}
    {pageaddvar name="javascript" value="http://yui.yahooapis.com/2.9.0/build/container/container_core-min.js"}
    {pageaddvar name="javascript" value="http://yui.yahooapis.com/2.9.0/build/menu/menu-min.js"}
    {pageaddvar name="javascript" value="http://yui.yahooapis.com/2.9.0/build/button/button-min.js"}
    {pageaddvar name="javascript" value="http://yui.yahooapis.com/2.9.0/build/editor/editor-min.js"}
{/if}



<script type="text/javascript">
/* <![CDATA[ */

    document.observe('dom:loaded', function() 
    {
        if (!$$('body')[0].hasClassName('yui-skin-sam')) {
            $$('body')[0].addClassName('yui-skin-sam');
        }
//        $('extendedhookslinks').addClassName('z-show');
    }
    ); 

    {{section name=modareas loop=$modareas}}
    var myEditor = new YAHOO.widget.{{if $type eq "Simple"}}Simple{{/if}}Editor('{{$modareas[modareas]}}', {
        handleSubmit: true,
        height: '{{if $height eq "auto"}}auto{{else}}{{$height}}px{{/if}}',
        width: '{{if $width eq "auto"}}auto{{else}}{{$width}}px{{/if}}',
        dompath: {{if $dombar}}true{{else}}false{{/if}},
        animate: {{if $animate}}true{{else}}false{{/if}},
        toolbar: {
            collapse: {{if $collapse}}true{{else}}false{{/if}},
            draggable: false,
            buttonType: 'advanced',
            titlebar: 'Scribite - YUI Rich Text Editor for {{$modname}}',
            {{if $type eq 'Full'}}
            buttons: [
                { group: 'fontstyle', label: 'Font Name and Size',
                    buttons: [
                        { type: 'select', label: 'Arial', value: 'fontname', disabled: true,
                            menu: [
                                { text: 'Arial', checked: true },
                                { text: 'Arial Black' },
                                { text: 'Comic Sans MS' },
                                { text: 'Courier New' },
                                { text: 'Lucida Console' },
                                { text: 'Tahoma' },
                                { text: 'Times New Roman' },
                                { text: 'Trebuchet MS' },
                                { text: 'Verdana' }
                            ]
                        },
                        { type: 'spin', label: '12', value: 'fontsize', range: [ 9, 75 ], disabled: true }
                    ]
                },
                { type: 'separator' },
                { group: 'textstyle', label: 'Font Style',
                    buttons: [
                        { type: 'push', label: 'Bold CTRL + SHIFT + B', value: 'bold' },
                        { type: 'push', label: 'Italic CTRL + SHIFT + I', value: 'italic' },
                        { type: 'push', label: 'Underline CTRL + SHIFT + U', value: 'underline' },
                        { type: 'separator' },
                        { type: 'push', label: 'Subscript', value: 'subscript', disabled: true },
                        { type: 'push', label: 'Superscript', value: 'superscript', disabled: true },
                        { type: 'separator' },
                        { type: 'color', label: 'Font Color', value: 'forecolor', disabled: true },
                        { type: 'color', label: 'Background Color', value: 'backcolor', disabled: true },
                        { type: 'separator' },
                        { type: 'push', label: 'Remove Formatting', value: 'removeformat', disabled: true },
                        { type: 'push', label: 'Show/Hide Hidden Elements', value: 'hiddenelements' }
                    ]
                },
                { type: 'separator' },
                { group: 'alignment', label: 'Alignment',
                    buttons: [
                        { type: 'push', label: 'Align Left CTRL + SHIFT + [', value: 'justifyleft' },
                        { type: 'push', label: 'Align Center CTRL + SHIFT + |', value: 'justifycenter' },
                        { type: 'push', label: 'Align Right CTRL + SHIFT + ]', value: 'justifyright' },
                        { type: 'push', label: 'Justify', value: 'justifyfull' }
                    ]
                },
                { type: 'separator' },
                { group: 'parastyle', label: 'Paragraph Style',
                    buttons: [
                    { type: 'select', label: 'Normal', value: 'heading', disabled: true,
                        menu: [
                            { text: 'Normal', value: 'none', checked: true },
                            { text: 'Header 1', value: 'h1' },
                            { text: 'Header 2', value: 'h2' },
                            { text: 'Header 3', value: 'h3' },
                            { text: 'Header 4', value: 'h4' },
                            { text: 'Header 5', value: 'h5' },
                            { text: 'Header 6', value: 'h6' }
                        ]
                    }
                    ]
                },
                { type: 'separator' },
                { group: 'indentlist', label: 'Indenting and Lists',
                    buttons: [
                        { type: 'push', label: 'Indent', value: 'indent', disabled: true },
                        { type: 'push', label: 'Outdent', value: 'outdent', disabled: true },
                        { type: 'push', label: 'Create an Unordered List', value: 'insertunorderedlist' },
                        { type: 'push', label: 'Create an Ordered List', value: 'insertorderedlist' }
                    ]
                },
                { type: 'separator' },
                { group: 'insertitem', label: 'Insert Item',
                    buttons: [
                        { type: 'push', label: 'HTML Link CTRL + SHIFT + L', value: 'createlink', disabled: true },
                        { type: 'push', label: 'Insert Image', value: 'insertimage' }
                    ]
                }
            ]
            {{else}}
            buttons: [
                { group: 'fontstyle', label: 'Font Name and Size',
                    buttons: [
                        { type: 'select', label: 'Arial', value: 'fontname', disabled: true,
                            menu: [
                                { text: 'Arial', checked: true },
                                { text: 'Arial Black' },
                                { text: 'Comic Sans MS' },
                                { text: 'Courier New' },
                                { text: 'Lucida Console' },
                                { text: 'Tahoma' },
                                { text: 'Times New Roman' },
                                { text: 'Trebuchet MS' },
                                { text: 'Verdana' }
                            ]
                        },
                        { type: 'spin', label: '12', value: 'fontsize', range: [ 9, 75 ], disabled: true }
                    ]
                },
                { type: 'separator' },
                { group: 'textstyle', label: 'Font Style',
                    buttons: [
                        { type: 'push', label: 'Bold CTRL + SHIFT + B', value: 'bold' },
                        { type: 'push', label: 'Italic CTRL + SHIFT + I', value: 'italic' },
                        { type: 'push', label: 'Underline CTRL + SHIFT + U', value: 'underline' },
                        { type: 'separator' },
                        { type: 'color', label: 'Font Color', value: 'forecolor', disabled: true },
                        { type: 'color', label: 'Background Color', value: 'backcolor', disabled: true }
                    ]
                },
                { type: 'separator' },
                { group: 'indentlist', label: 'Lists',
                    buttons: [
                        { type: 'push', label: 'Create an Unordered List', value: 'insertunorderedlist' },
                        { type: 'push', label: 'Create an Ordered List', value: 'insertorderedlist' }
                    ]
                },
                { type: 'separator' },
                { group: 'insertitem', label: 'Insert Item',
                    buttons: [
                        { type: 'push', label: 'HTML Link CTRL + SHIFT + L', value: 'createlink', disabled: true },
                        { type: 'push', label: 'Insert Image', value: 'insertimage' }
                    ]
                }
            ]
            {{/if}}
        }
    });
    myEditor.render();

    {{/section}}
/* ]]> */
</script>
<!-- end Scribite with YUI Rich Text Editor -->