<!-- start Scribite with wymeditor for {$Scribite.modname} -->
{pageaddvar name="javascript" value="jquery"}
{pageaddvar name="javascript" value="modules/Scribite/plugins/WYMeditor/vendor/wymeditor/jquery.wymeditor.min.js"}

<script type="text/javascript">
    jQuery(function() {
        var textareaList = document.getElementsByTagName('textarea');
        for(i = 0; i < textareaList.length; i++) {
            // check to make sure textarea not in disabled list or has 'noeditor' class
            if ((jQuery.inArray(textareaList[i].id, disabledTextareas) == -1) && !jQuery('#' + textareaList[i].id).hasClass('noeditor')) {
                // attach the editor
                jQuery('#' + textareaList[i].id).wymeditor({
                    lang: '{{$lang}}'   
                });
            }
        }
    });
</script>
<!-- end Scribite with wymeditor -->