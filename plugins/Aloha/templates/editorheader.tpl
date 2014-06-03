<!-- start Scribite with Aloha for {$Scribite.modname} -->
{pageaddvar name="javascript" value="jquery"}
{pageaddvar name="stylesheet" value="http://cdn.aloha-editor.org/latest/css/aloha.css"}
{pageaddvar name="javascript" value="http://cdn.aloha-editor.org/latest/lib/require.js"}
{pageaddvar name="javascript" value="modules/Scribite/plugins/Aloha/javascript/Aloha.ajaxApi.js"}

<!-- load the Aloha Editor core and some plugins -->
<script src="http://cdn.aloha-editor.org/latest/lib/aloha.js"
                    data-aloha-plugins="common/ui,
                                         common/format,
                                         common/list,
                                         common/link,
                                         common/highlighteditables">
</script>

<script type="text/javascript">
/* <![CDATA[ */
    // instantiate Aloha Scribite object for editor creation and ajax manipulation
    Scribite = new ScribiteUtil();
    if (window.addEventListener) { // modern browsers
        window.addEventListener('load' , Scribite.createEditors, false);
    } else if (window.attachEvent) { // ie8 and even older browsers
        window.attachEvent('onload', Scribite.createEditors);
    } else { // fallback, not truly necessary
        window.onload = Scribite.createEditors;
    }
 /* ]]> */
</script>
<!-- end Scribite with Aloha -->