Scribite ModVars structure
==========================

The structure of the override modvar array is like so:

    $overrides = array(
        'News' => array('editor' => 'CKEditor',
            'textarea1' => array('disabled' => false,
                                 'params' => array(param => value, param => value, param => value)),
            'textarea2' => array('disabled' => true)),
        'PostCalendar' => array(
            'textarea1' => array('disabled' => false,
                                 'params' => array(param => value, param => value, param => value)),
            'textarea2' => array('disabled' => true))
    );

Thre resulting controller vars:

    $editor = $overrides['News']['editor']; // CKEditor
    $editor = $overrides['PostCalendar']['editor']; // not set

There are also used several 'standard' modvars in use.
