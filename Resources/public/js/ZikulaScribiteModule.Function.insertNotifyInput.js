/**
 * Insert a hidden input field to pass to subscriber module if it wants
 * to identify if a WYSIWYG editor has been used.
 * @see docs/en/dev/README.markdown
 * 
 * @param string textAreaId
 * @return void
 */
var insertNotifyInput = function (textAreaId) {
    var hiddenField = document.createElement('input');
    hiddenField.setAttribute('id', 'scribiteeditorused.' + textAreaId);
    hiddenField.setAttribute('name', 'scribiteeditorused[' + textAreaId + ']');
    hiddenField.setAttribute('type', 'hidden');
    hiddenField.setAttribute('value', '1');
    var textareaEle = document.getElementById(textAreaId);
    if (null !== textareaEle) {
        var formEle = textareaEle.parentNode;
        formEle.insertBefore(hiddenField, textareaEle);
    }
}
