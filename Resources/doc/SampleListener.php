<?php

namespace Acme\FooModule\Listener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Zikula\ScribiteModule\Event\EditorHelperEvent;

class SampleListener implements EventSubscriberInterface
{
    public function addHelper(EditorHelperEvent $event)
    {
        $event->getHelpers()->add([
            'module' => 'AcmeFooModule',
            'type' => 'javascript',
            'path' => 'modules/acmefoo/js/myHelperScript.js' // relative to /web
        ]);
        $event->getHelpers()->add([
            'module' => 'AcmeFooModule',
            'type' => 'stylesheet',
            'path' => 'modules/acmefoo/css/myHelperStyles.css' // relative to /web
        ]);
    }

    public static function getSubscribedEvents()
    {
        return [
            'module.scribite.editorhelpers' => [
                'addHelper'
            ]
        ];
    }
}
