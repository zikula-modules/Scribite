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

You can choose the editor you wish to use in the module settings.

For advanced users, you can also specify a string of values which will be passed
to the template for use in rendering the template.


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

If you would like to assign specific parameters to a textarea for use in the 
template or you would like to disable one of the textareas (but not all of them)
on a page, you can do so in the template override section. These parameters
become available in the template like so:

    $modvars.Scribite.overrides.<modulename>.<textareaid>.params.<param> = <value>
