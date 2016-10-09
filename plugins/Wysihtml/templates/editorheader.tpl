<!-- start Scribite with Wysihtml for {$Scribite.modname} -->
{pageaddvar name='javascript' value='jquery'}
{pageaddvar name='stylesheet' value='modules/Scribite/plugins/Wysihtml/style/style.css'}
{pageaddvar name='javascript' value='modules/Scribite/plugins/Wysihtml/vendor/minified/wysihtml.min.js'}
{pageaddvar name='javascript' value='modules/Scribite/plugins/Wysihtml/vendor/minified/wysihtml.all-commands.min.js'}
{pageaddvar name='javascript' value='modules/Scribite/plugins/Wysihtml/vendor/minified/wysihtml.table_editing.min.js'}
{pageaddvar name='javascript' value='modules/Scribite/plugins/Wysihtml/vendor/minified/wysihtml.toolbar.min.js'}
{pageaddvar name='javascript' value='modules/Scribite/plugins/Wysihtml/vendor/parser_rules/simple.js'}
{pageaddvar name='javascript' value='modules/Scribite/plugins/Wysihtml/javascript/Wysihtml.ajaxApi.js'}

<script type="text/javascript">
    var toolbarHtml = '{{include file='toolbar.tpl'}}';

    (function($) {
        $(document).ready(function() {
            // instantiate Scribite object for editor creation and ajax manipulation
            Scribite = new ScribiteUtil();
            Scribite.createEditors();
        });
    })(jQuery)
</script>
<!-- end Scribite with Wysihtml for {$Scribite.modname} -->
