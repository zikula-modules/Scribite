Adding Editors
==============

Editors can be added to scribite by **any** module.

A module must create a service and tag that service as `scribite.editor` and also include a unique **id**. See example:

    services:
        zikula_scribite_module.editor.ckeditor:
            class: Zikula\ScribiteModule\Editor\CKEditor\CKEditor
            arguments:
              - '@translator.default'
              - '@zikula_extensions_module.api.variable'
              - '@event_dispatcher'
            tags:
              - { name: scribite.editor, id: CKEditor }

The class must implement *at least* `Zikula\ScribiteModule\Editor\EditorInterface` the class may optionally implement
`Zikula\ScribiteModule\Editor\ConfigurableEditorInterface` 
and/or `Zikula\ScribiteModule\Editor\EditorHelperProviderInterface`

Each interface requires specific methods. See `Zikula\ScribiteModule\Editor\CKEditor\CKEditor` for example.
