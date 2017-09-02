Scribite 6.0.0 Developer README
===============================

Disabling the editor via the template
-------------------------------------

If you have a textarea within your module that you would like to not allow your users to use a WYSIWYG editor, simply
add 'noeditor' class to the textarea and the editor will not be activated for that textarea only (others will still
work). like so:

    <textarea id='hometext' class='noeditor' name='' rows='8' cols='80'>


Providing unique DOM id's for each textarea
-------------------------------------------

It is the responsibility of each subscriber module to provide a unique DOM id for the form textarea(s) within a module.
Ids in the user and admin areas must not be the same. This is simply to facilitate unique textarea overrides from
Scribite. The DOM `name` can be whatever the module dev prefers, but the Id must be unique within the module scope.


Testing for the use of the editor
---------------------------------

Scribite inserts a hidden input form field in the subscriber form when the editor has been attached to the textarea. The
hidden input will look something like this:

    <input value="1" name="scribiteeditorused[hometext]" id="scribiteeditorused.hometext" type="hidden">

This will allow the controller in the subscriber module to test for the use of the editor in the processing of the data
if desired. For example:

    $editoruse = $this->request->request->get('scribiteeditorused', false);
    if (!empty($editoruse['hometext']) && ($editoruse['hometext'] == 1)) {
        $formattedTextinTextarea = true;
    } else {
        $formattedTextinTextarea = false;
    }


Adding PageVars to the editor
-----------------------------

(such as media handling javascript or css files)

Any module that needs to add page vars (javascript, css, etc) can use an Event Listener to load their helper every time
a Scribite editor is loaded.

see `SampleListener.php` for an implementation example. All listeners must be registered with the DI component:

    services:
        acme_foo_module.listener.sample_listener:
            class: Acme\FooModule\Listener\SampleListener
            tags:
                - { name: kernel.event_subscriber }

A module can add as many helpers as required (any standard PageVar) in one listener.


Adding External *editor* plugins to an editor
---------------------------------------------

Some editors support the loading of external editor plugins (e.g. plugins stored elsewhere in the system, like in a
media module). Currently only CKEditor and TinyMCE support this behavior and have it implemented in Scribite. Please see
the CKEditor editor for an example of this.


Adding new Editor plugins to Scribite
-------------------------------------

See the README.markdown in the editors directory for more information.
