Scribite 5.0.0
==============

_Unreleased (under development)_

NOTE: This version works with Zikula Core 1.3 series.

Scribite is a module for the Zikula Application Framework that inserts a 
selected javascript WYSIWYG editor into textareas.

Scribite 5.0.0 is a significant departure from previous versions. Because of
this, there is no upgrade available from the 4.x series. When you run the 
upgrade routine, it will simply uninstall, then reinstall the module. All
previous settings will be lost (they don't mean anything to the new version
anyway).

The biggest change from previous versions is that the model is changed from 
*including* module/textareas to *excluding* them. Scribite also is strictly
a 'hook-based' module and the loader cannot be called via an API call anymore.

Scribite now assumes that (in general) most users want *all* textareas to have
a text editor. Simply hook Scribite to your subscriber module and it works!
For 'power users', fine-grain configuration is possible however.

Other significant changes include storing all data in the modvars table instead 
of a module-specific table. And the conversion of all editors to module plugins.
This will made future addition/subtraction of editors very easy.