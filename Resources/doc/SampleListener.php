<?php

declare(strict_types=1);

namespace Acme\FooModule\Listener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Zikula\ScribiteModule\Event\EditorHelperEvent;

class SampleListener implements EventSubscriberInterface
{
    public function addHelper(EditorHelperEvent $event)
    {
        if ('CKEditor' === $event->getEditor()) {
            $event->getHelperCollection()->add([
                'module' => 'AcmeFooModule',
                'type' => 'javascript',
                'path' => 'modules/acmefoo/js/myHelperScript.js' // relative to /public
            ]);
            $event->getHelperCollection()->add([
                'module' => 'AcmeFooModule',
                'type' => 'stylesheet',
                'path' => 'modules/acmefoo/css/myHelperStyles.css' // relative to /public
            ]);
        }
    }

    public static function getSubscribedEvents()
    {
        return [
            EditorHelperEvent::class => [
                'addHelper'
            ]
        ];
    }
}
