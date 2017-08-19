Scribite 5.0.3
==============

- Aloha updated from 1.4.9 to 1.4.23
- CodeMirror updated from from 5.17.0 to 5.21.0

Scribite 5.0.2
==============

This version removes NicEdit, Xinha and YUI which are not maintained anymore.

A new plugin for CodeMirror (http://codemirror.net) has been added.

All other editors are updated to the latest version. Also several additions are done,
like new configuration forms, code cleanups and continued migration to jQuery.

This is the last release which is compatible with Zikula 1.3.x. Scribite 5.1.0 is going
to be the first 1.4 only version.


Scribite 5.0.0
==============

_Released 15 May 2014_

NOTE: This version works with Zikula Core 1.3 series. (Requires Core 1.3.5+)

Scribite is a module for the Zikula Application Framework that inserts a 
selected javascript WYSIWYG editor into textareas through the use of Zikula hooks.

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
For 'power users', fine-grain configuration is possible however (more with
some editors than others).

* Other significant changes include storing all data in the modvars table instead 
of a module-specific table, and the conversion of all editors to module plugins.
This will make future addition/subtraction of editors very easy.

* The choice of editors has also become wider and configuring the editors can be done a lot easier from within Zikula itself. CKEditor for instance can be controlled quite good from the configuration settings of the module plugin. No need to edit configuration files on the server any more. Of course you can still do all that if you want. Due to the module plugin structure the editors are in seperate clear folders. See the editor module plugins https://github.com/zikula-modules/Scribite/tree/master/plugins here. There is also more information on the plugins.

* Another new is that 3rd party modules can now provide plugins to scribite from within the module itself. By adhering to the new external plugin structure for the editors that support this, it is now easier to make a editor plugin.

