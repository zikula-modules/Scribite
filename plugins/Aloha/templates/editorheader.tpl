<!-- start Scribite with Aloha for {$Scribite.modname} -->
{pageaddvar name='javascript' value='modules/Scribite/plugins/Aloha/vendor/aloha/lib/require.js'}
{pageaddvar name='javascript' value='jquery'}
{pageaddvar name='stylesheet' value='modules/Scribite/plugins/Aloha/vendor/aloha/css/aloha.css'}
{pageaddvar name='javascript' value='modules/Scribite/plugins/Aloha/javascript/Aloha.ajaxApi.js'}

<!-- load the Aloha Editor core and some plugins -->
<script src="modules/Scribite/plugins/Aloha/vendor/aloha/lib/aloha.js"
        data-aloha-plugins="common/ui,common/align,common/format,common/highlighteditables,common/image,common/link,common/list,common/undo">
</script>

<script type="text/javascript">
/* <![CDATA[ */
    var scribite_init = function () {
        // variable for storing the instantiated editors
        var textareaList = document.getElementsByTagName('textarea');
        for (i = 0; i < textareaList.length; i++) {
            var areaId = textareaList[i].id;

            // ensure textarea not in disabled list or has 'noeditor' class
            if ((disabledTextareas.indexOf(areaId) == -1) && !(textareaList[i].className.split(' ').indexOf('noeditor') > -1)) {
                // attach editor
                Aloha.ready( function() {
                    Aloha.jQuery('#' + areaId).aloha();
                });

                // notify subscriber
                insertNotifyInput(areaId);
            }
        }
    };

    (function($) {
        $(document).ready(function() {
            // instantiate Scribite object for editor creation and ajax manipulation
            Scribite = new ScribiteUtil();
            if (window.addEventListener) { // modern browsers
                window.addEventListener('load', Scribite.createEditors, false);
            } else if (window.attachEvent) { // ie8 and even older browsers
                window.attachEvent('onload', Scribite.createEditors);
            } else { // fallback, not truly necessary
                window.onload = Scribite.createEditors;
            }
        });
    })(jQuery)
 /* ]]> */
</script>
<!-- end Scribite with Aloha for {$Scribite.modname} -->
