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


Providing unique DOM id's for each textarea
-------------------------------------------

It is the responsibility of each subscriber module to provide a unique DOM id for
the form textarea(s) within a module. Ids in the user and admin areas should not
be the same. This is simply to facilititate unique textarea overrides from
scribite (this is because Scribite is unaware of the `func` url paramater now). 
The DOM `name` can be whatever the module dev prefers, but the Id should be
unique within the module scope.


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

(such as media handling javascript or css files)

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


Adding External *editor* plugins to an editor
---------------------------------------------

Some editors support the loading of external editor plugins (e.g. plugins stored
elsewhere in the system, like in a media module). Currently only CKEditor and
TinyMCE support this behavior and have it implemented in Scribite. Please see
the CKEditor plugin for an example of this and see SimpleMedia for an
implementation.

The system uses an event similar to the PageVar listeners above to gather
plugins and provide them to the editorheader.tpl where they must be loaded as
required by the individual editor. The name of the event will be like:

    `moduleplugin.<editorname>.externalplugins`

The subject of the event should be a class that is used to create a stack of
plugins. See ModulePlugin_Scribite_CKEditor_EditorPlugin as an example.


Adding new Editor plugins to Scribite
-------------------------------------

See the README.markdown in the editors directory for more information.
