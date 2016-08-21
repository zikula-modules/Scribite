<!-- start Scribite with Wysihtml for {$Scribite.modname} -->
{pageaddvar name='stylesheet' value='modules/Scribite/plugins/Wysihtml/style/style.css'}
{pageaddvar name='javascript' value='modules/Scribite/plugins/Wysihtml/vendor/minified/wysihtml.min.js'}
{pageaddvar name='javascript' value='modules/Scribite/plugins/Wysihtml/vendor/minified/wysihtml.all-commands.js'}
{pageaddvar name='javascript' value='modules/Scribite/plugins/Wysihtml/vendor/minified/wysihtml.table_editing.js'}
{pageaddvar name='javascript' value='modules/Scribite/plugins/Wysihtml/vendor/minified/wysihtml.toolbar.min.js'}
{pageaddvar name='javascript' value='modules/Scribite/plugins/Wysihtml/vendor/parser_rules/simple.js'}
{pageaddvar name='javascript' value='modules/Scribite/plugins/Wysihtml/javascript/Wysihtml.ajaxApi.js'}

<script type="text/javascript">
    var toolbarhtml = '{{include file='toolbar.tpl'}}';
    // instantiate Scribite object for editor creation and ajax manipulation
    Scribite = new ScribiteUtil();

    if (window.addEventListener) { // modern browsers
        window.addEventListener('load', Scribite.createEditors, false);
    } else if (window.attachEvent) { // ie8 and even older browsers
        window.attachEvent('onload', Scribite.createEditors);
    } else { // fallback, not truly necessary
        window.onload = Scribite.createEditors;
    }
</script>
<!-- end Scribite with Wysihtml for {$Scribite.modname} -->
