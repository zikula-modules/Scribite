<!-- start Scribite with wymeditor for {$Scribite.modname} -->
{pageaddvar name="javascript" value="jquery"}
{pageaddvar name="stylesheet" value="modules/Scribite/plugins/WYMeditor/style/style.css"}
{pageaddvar name="javascript" value="modules/Scribite/plugins/WYMeditor/vendor/wymeditor/jquery.wymeditor.min.js"}

<script type="text/javascript">
    jQuery(function() {
        var textareaList = document.getElementsByTagName('textarea');
        for(i = 0; i < textareaList.length; i++) {
            // check to make sure textarea not in disabled list or has 'noeditor' class
            if ((jQuery.inArray(textareaList[i].id, disabledTextareas) == -1) && !jQuery('#' + textareaList[i].id).hasClass('noeditor')) {
                // attach the editor
                jQuery('#' + textareaList[i].id).wymeditor({
                    lang: '{{$lang}}',
                    updateEvent: 'click',
                    updateSelector: '[type=submit]'
                });
            }
        }
    });
	// Notify subscriber outside jQuery call to WYMeditor
    var textareaList = document.getElementsByTagName('textarea');
	for(i = 0; i < textareaList.length; i++) {
		// check to make sure textarea not in disabled list or has 'noeditor' class
		// this editor does not use jQuery or prototype so reverting to manual JS
		var textareaId = textareaList[i].id;
        if ((disabledTextareas.indexOf(textareaId) == -1) && !(textareaList[i].className.split(' ').indexOf('noeditor') > -1)) {
			// notify subscriber
			insertNotifyInput(textareaList[i].id);
		}
	}
</script>
<!-- end Scribite with wymeditor -->
