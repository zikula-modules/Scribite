Adding Editors
==============

Editors can be added to scribite by **any** module.

The class must implement *at least* `Zikula\ScribiteModule\Editor\EditorInterface` the class may optionally implement
`Zikula\ScribiteModule\Editor\ConfigurableEditorInterface` 
and/or `Zikula\ScribiteModule\Editor\EditorHelperProviderInterface`

Each interface requires specific methods. See `Zikula\ScribiteModule\Editor\CKEditor\CKEditor` for example.

The `<Editor>/Resources/views/editorheader.html.twig` template is required and must configure and load the editor
library using the Javascript API as identified in the other editors.

- Within `editorheader.html.twig` be sure to copy existing examples. Especially note how all textareas are fetched via 
    javascript and tested for the existence of a  'noeditor' class and also if the selected textarea is in the 
    disabledTextareas array. Lastly, note `that insertNotifyInput(textareaList[i].id);` is called to notify the 
    subscriber module of the use of the editor.
- A Javascript API has been outlined to allow subscriber modules to fetch data, enable and destroy instances of the 
    editors as part of the Scribite object. A good example is located in CKEditor/javascript/CKEditor.ajaxApi.js. It is 
    important that your methods and final object have exactly the same name as all the other editors so that they can be 
    utilized by the subscriber.

