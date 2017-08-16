Scribite 5.0.0 Installation and Usage
=====================================

Scribite is installed the same as any Zikula module from the Extensions page.

Scribite works as a *hook-based* module __only__. This means in order to utilize
its functions, you must hook Scribite (the provider) to the module you wish to
use the editors in (the subscriber). To hook them together, go the the 
subscriber module's admin page and click the last links in the admin bar 
(hooks). You will see a drag and drop interface allowing you to drag Scribite to
your intended subscriber. After this, go to your subscriber's 'new item' page
and the textarea should have a new WYSIWYG editor!


Scribite Settings
-----------------

Choose the editor you wish to use for all modules in the module settings.


Editor Settings
---------------

Each editor has it's own settings. These are configured through the Module
Plugins interface in the Extensions module. Items like width and toolbar choices
are set here.


Module and textarea overrides
-----------------------------

For advanced users, it is possible to exert fine-grained control on exactly how 
you would like your editors to work. You can do this through module and textarea
overrides.

If you would like a specific module to use an editor different than the default,
you can set this as a module override by selecting the module and choosing an
editor.

Please note: in previous versions of scribite it was possible to configure
editor choices based on the *function* of the subscribing module. This is no
longer possible in favor of the hooks-based solution. The subscriber module
is responsible to provide unique textarea names for all subscriber areas in 
order to allow the most fine-grained customization via Scribite.

If you would like to assign specific editor parameters to a textarea for use in
the  template or you would like to disable one of the textareas (but not all of
them) on a page, you can do so in the textarea override section. These
parameters will be applied to the editor's config object as appropriate. Not
every editor supports custom configuration nor does the included plugin version
necessarily implement the custom config, if available. (Currently, only CKEditor
and TinyMCE support parameter overrides.) The parameters and their values must
make sense to the editor or they could cause unusual behavior in the editor.
Values here will override default values in editorheader.tpl.

In order to make param overrides work, a functional knowledge of the editor and
its underlying configuration mechanism will be required.

Image upload with KCFinder
--------------------------
CKEditor and TinyMCE editors can be integrated with KCFinder web file manager 
(http://kcfinder.sunhater.com/). This provides to them the ability to upload images 
from the editor interface (via image buttons).
For now in Scribite integration is automated for CKEditor only.

Steps to install:
1. Download KCFinder Zikula plugin from here: https://github.com/nmpetkov/Kcfinder-zk.
2. Install and configure plugin (see plugin documentation).
3. In Scribite, Plugins (Manage editors), CKEditor, Configure plugin, in field 
"Path to filemanager" enter valid path to KCFinder, something as "utils/kcfinder".

Now Scribite will automatically integrate KCFinder interface into CKEditor, and now 
have to exists upload and browse functionalities for images and other permitted files.
Permissions are configurable from KCFinder Zikula system plugin.
