Scribite is a module for the Zikula Application Framework that inserts a 
selected javascript WYSIWYG editor into textareas through the use of Zikula hooks.

Scribite 6.0.2
==============

- Updated Quill from version 1.3.2 to 1.3.6.
- Updated Summernote from version 0.8.7 to 0.8.10.

Scribite 6.0.1
==============

- Explicitly set template name in annotation (prevents problems in Zikula 2.x).

Scribite 6.0.0
==============

- Rewritten for Zikula Core 2.x, but supports 1.5.0+.
- Editors are now included using tagged services. Thus, also 3rd party modules can contribute additional editors.
- Removed editors: Markitup, Wymeditor, Wysihtml
- Added new editor: Quill version 1.3.2
- Added new editor: Summernote version 0.8.7
- Updated CKEditor from version 4.6.2 to 4.7.2.
- Updated CodeMirror from version 5.21.0 to 5.29.0.
- Updated TinyMCE from version 4.4.1 to 4.6.6.

Scribite 5.0.3
==============

- Removed editors: Aloha.
- Updated CodeMirror from version 5.17.0 to 5.21.0.
- Last release compatible with Zikula < 1.5.

Scribite 5.0.2
==============

- Removed editors: NicEdit, Xinha and YUI.
- Added new editor: CodeMirror.
- Updated all other editors to the latest version.
- Several additions, like new configuration forms, code cleanups and continued migration to jQuery.


Scribite 5.0.0
==============

NOTE: This version works with Zikula Core 1.3 series. (Requires Core 1.3.5+)

* Scribite 5.0.0 is a significant departure from previous versions. Because of
this, there is no upgrade available from the 4.x series. When you run the 
upgrade routine, it will simply uninstall, then reinstall the module. All
previous settings will be lost (they don't mean anything to the new version
anyway).

* The biggest usage change from previous versions is that the model is changed from 
manually *including* module/textareas to manually *excluding* them. Scribite
is now a strictly 'hook-based' module and the loader cannot be called via an
API call anymore.

* Scribite now assumes that (in general) most users want *all* textareas to have
a text editor. Simply hook Scribite to your subscriber module and it works!

* Other significant changes include storing all data in the modvars table instead 
of a module-specific table, and the conversion of all editors to module plugins.
This will make future addition/subtraction of editors very easy.

* The choice of editors has also become wider and configuring the editors can be done a lot easier from within Zikula itself. CKEditor for instance can be controlled quite good from the configuration settings of the module plugin. The editors are now stored in seperate clear folders.

* 3rd party modules can now provide plugins to Scribite from within the module itself using event listeners.
