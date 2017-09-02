TinyMceEditor
=============

### Events

TinyMceEditor dispatches an event `moduleplugin.tinymce.externalplugins`. The subject is and instance of
`Zikula\ScribiteModule\Editor\TinyMce\Collection\PluginCollection`. A module developer can use this event to add
editor plugins within a listener:

    class SampleListener implements EventSubscriberInterface
    {
        public function addPlugin(GenericEvent $event)
        {
            $event->getSubject()->add([
                'name' => 'pluginName',
                'path' => 'modules/acmefoo/js/myPlugin.js' // relative to /web
            ]);
        }
    
        public static function getSubscribedEvents()
        {
            return [
                'moduleplugin.tinymce.externalplugins' => [
                    'addPlugin'
                ]
            ];
        }
    }
