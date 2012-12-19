Scribite 5.0.0 Developer README
===============================

Scribite can no longer be loaded via an API call. It has intentionally been
hidden as a private method of a non-API class so that is completely inaccessible
to other modules. If you require this functionality, you must use an older
version of Scribite or (even better) upgrade your module to use Zikula hooks
properly.

If you have a textarea within your module that you would like to not allow your
users to use a WYSIWYG editor, simply add 'noeditor' class to the textarea and
the editor will not be activated for that textarea only (others will still 
work). like so:

    <textarea id='hometext' class='noeditor' name='' rows='8' cols='80'>