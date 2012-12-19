Scribite Plugins
================

Creating a plugin
-----------------

Plugins can be added after Scribite is released and so writing and using your
own plugin is a great way to improve the functionality of Scribite for your own
site.

When writing your own plugin please copy the structure of the existing plugins.

The Plugin.php is required.

images/logo.png should be present for your plugin

templates/configure.tpl is a template used by a Zikula_Form_View class to set
parameters that the editorheader.tpl will use (the values are sent in the
modvars array).

editorheader.tpl should load and configure the javascript needed for the editor.


Plugin Meta Info
================

displayname: the name you wish displayed
description: a short description of the functionality.
version: the version of the vendor lib
url: the site where the vendor is location
license: use SPDX license abbreviation from http://www.spdx.org/licenses/
dependencies: other libraries (e.g. jQuery or such) that must be loaded. Please
   note that this is not used in the code, it is just information.