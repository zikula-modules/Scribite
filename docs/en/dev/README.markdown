Scribite 5.0.0 Developer README
===============================

Loading via API
---------------

Scribite can no longer be loaded via an API call. It has intentionally been
hidden as a private method of a non-API class so that is completely inaccessible
to other modules. If you require this functionality, you must use an older
version of Scribite or (even better) upgrade your module to use Zikula hooks
properly.


Disabling the editor via the template
-------------------------------------

If you have a textarea within your module that you would like to not allow your
users to use a WYSIWYG editor, simply add 'noeditor' class to the textarea and
the editor will not be activated for that textarea only (others will still 
work). like so:

    <textarea id='hometext' class='noeditor' name='' rows='8' cols='80'>


Testing for the use of the editor
---------------------------------

Scribite now inserts a hidden input form field in the subscriber form when the
editor has been attached to the textarea. The hidden input will look something
like this:

    <input value="1" name="scribiteeditorused[hometext]" id="scribiteeditorused.hometext" type="hidden">

This will allow the controller in the subscriber module to test for the use of
the editor in the processing of the data if desired. For example:

    $editoruse = $this->request->request->get('scribiteeditorused', false);
    if (!empty($editoruse['hometext']) && ($editoruse['hometext'] == 1)) {
        $formattedTextinTextarea = true;
    } else {
        $formattedTextinTextarea = false;
    }

Adding PageVars to the editor
-----------------------------

(such as media handling javascript)

Any module that needs to add page vars (javascript, css, etc) can use a 
PersistentModuleHandler to automatically load their helper every time a Scribite
editor is loaded.

in SimpleMedia_Installer::install()

    EventUtil::registerPersistentModuleHandler('SimpleMedia', 'module.scribite.editorhelpers', array('SimpleMedia_Handlers', 'getHelpers'));

in SimpleMedia_Handlers::getHelpers(Zikula_Event $event)

    $editor = $event->getArg('editor'); // could use for logic choices on what to add.
    $event->getSubject()->add(array('module' => 'SimpleMedia',
             'type' => 'javascript',
             'path' => 'modules/SimpleMedia/javascript/findItem.js'));


A module can add as many helpers as required (any standard PageVar)