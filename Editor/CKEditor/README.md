CKEditor
========

### Events

CKEditor dispatches an event `moduleplugin.ckeditor.externalplugins`. The subject is and instance of
`Zikula\ScribiteModule\Editor\CKEditor\Collection\PluginCollection`. A module developer can use this event to add
editor plugins within a listener:

    class SampleListener implements EventSubscriberInterface
    {
        public function addPlugin(GenericEvent $event)
        {
            $event->getSubject()->add([
                'name' => 'acmefoomodule',
                'path' => 'modules/acmefoo/js/', // relative to /web
                'file' => 'myHelperScript.js',
                'img' => 'modules/acmefoo/images/image.png' // relative to /web
            ]);
        }
    
        public static function getSubscribedEvents()
        {
            return [
                'moduleplugin.ckeditor.externalplugins' => ['addPlugin']
            ];
        }
    }
