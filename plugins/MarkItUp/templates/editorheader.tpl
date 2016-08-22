<!-- start Scribite with markItUp! for {$Scribite.modname} -->
{pageaddvar name='javascript' value='jquery'}
{pageaddvar name='stylesheet' value='modules/Scribite/plugins/MarkItUp/style/style.css'}
{pageaddvar name='javascript' value='modules/Scribite/plugins/MarkItUp/vendor/markitup/jquery.markitup.js'}
{pageaddvar name='javascript' value='modules/Scribite/plugins/MarkItUp/vendor/markitup/sets/default/set.js'}
{pageaddvar name='stylesheet' value='modules/Scribite/plugins/MarkItUp/vendor/markitup/sets/default/style.css'}
{pageaddvar name='stylesheet' value='modules/Scribite/plugins/MarkItUp/vendor/markitup/skins/markitup/style.css'}
{pageaddvar name='javascript' value='modules/Scribite/plugins/MarkItUp/javascript/MarkItUp.ajaxApi.js'}

<script type="text/javascript">
/* <![CDATA[ */
    // instantiate Scribite object for editor creation and ajax manipulation
    var editorWidth = '{{if $Scribite.editorVars.width eq 'auto'}}auto{{else}}{{$Scribite.editorVars.width}}{{/if}}';
    var editorHeight = '{{if $Scribite.editorVars.height eq 'auto'}}auto{{else}}{{$Scribite.editorVars.height}}{{/if}}';
    Scribite = new ScribiteUtil();

    if (window.addEventListener) { // modern browsers
        window.addEventListener('load', Scribite.createEditors, false);
    } else if (window.attachEvent) { // ie8 and even older browsers
        window.attachEvent('onload', Scribite.createEditors);
    } else { // fallback, not truly necessary
        window.onload = Scribite.createEditors;
    }
/* ]]> */
</script>
<!-- end Scribite with markItUp! for {$Scribite.modname} -->
