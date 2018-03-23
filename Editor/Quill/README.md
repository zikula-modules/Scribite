QuillEditor
===========

### Events

QuillEditor dispatches an event `moduleplugin.quill.externalplugins`. The subject is and instance of
`Zikula\ScribiteModule\Editor\Quill\Collection\PluginCollection`. A module developer can use this event to add
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
                'moduleplugin.quill.externalplugins' => ['addPlugin']
            ];
        }
    }
