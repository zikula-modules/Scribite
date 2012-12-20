Scribite ModVars structure
==========================

The structure of the override modvar array is like so:

    $overrides = array(
        'News' => array('editor' => 'YUI',
                    'textarea1' => array('disabled' => false,
                                         'params' =>array(param => value, param => value, param => value)),
                    'textarea2' => array('disabled' => true)),
        'PostCalendar' => array(
                    'textarea1' => array('disabled' => false,
                                         'params' =>array(param => value, param => value, param => value)),
                    'textarea2' => array('disabled' => true))
    );


becomes template vars:

    $modvars.Scribite.overrides.News.textarea1.disabled = false
    $modvars.Scribite.overrides.News.textarea2.disabled = true
    $modvars.Scribite.overrides.News.textarea1.params.param = value

or controller vars:

    $editor = $overrides['News']['editor']; // YUI
    $editor = $overrides['PostCalendar']['editor']; // not set

There are also used several 'standard' modvars in use.
