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
    var editorWidth = '{{$Scribite.editorVars.width}}';
    var editorHeight = '{{$Scribite.editorVars.height}}';

    (function($) {
        $(document).ready(function() {
            // instantiate Scribite object for editor creation and ajax manipulation
            Scribite = new ScribiteUtil();
            Scribite.createEditors();
        });
    })(jQuery)
/* ]]> */
</script>
<!-- end Scribite with markItUp! for {$Scribite.modname} -->
