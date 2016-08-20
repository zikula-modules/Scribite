<!-- start Scribite with markItUp! for {$Scribite.modname} -->
{pageaddvar name='javascript' value='jquery'}
{pageaddvar name='stylesheet' value='modules/Scribite/plugins/MarkItUp/style/style.css'}
{pageaddvar name='javascript' value='modules/Scribite/plugins/MarkItUp/vendor/markitup/jquery.markitup.js'}
{pageaddvar name='javascript' value='modules/Scribite/plugins/MarkItUp/vendor/markitup/sets/default/set.js'}
{pageaddvar name='stylesheet' value='modules/Scribite/plugins/MarkItUp/vendor/markitup/sets/default/style.css'}
{pageaddvar name='stylesheet' value='modules/Scribite/plugins/MarkItUp/vendor/markitup/skins/markitup/style.css'}

<script type="text/javascript">
    (function($) {
        $(document).ready(function() {
            $('textarea').each(function(index) {
                var textArea = $(this);
                var areaId = textArea.attr('id');
                // ensure textarea not in disabled list or has 'noeditor' class
                if (($.inArray(areaId, disabledTextareas) == -1) && !textArea.hasClass('noeditor')) {
                    // attach the editor
                    textArea
                        .css({
                            width: '{{if $Scribite.editorVars.width eq "auto"}}auto{{else}}{{$Scribite.editorVars.width}}{{/if}}',
                            height: '{{if $Scribite.editorVars.height eq "auto"}}auto{{else}}{{$Scribite.editorVars.height}}{{/if}}'
                        })
                        .markItUp(mySettings);

                    // notify subscriber
                    insertNotifyInput(textareaList[i].id);
                }
            }
        });
    })(jQuery)
-->
</script>
<!-- end Scribite with markItUp! for {$Scribite.modname} -->
