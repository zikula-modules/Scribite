Scribite ModVars structure
==========================

The structure of the override modvar array is like so:

    $overriders = $this->getVar('overrides');

    $overrides = [
        'News' => [
            'editor' => 'CKEditor',
            'textarea1' => [
                'disabled' => false,
                'params' => [
                    param => value,
                    param => value,
                    param => value
                ]
            ],
            'textarea2' => ['disabled' => true]
        ],
        'PostCalendar' => [
            'textarea1' => [
                'disabled' => false,
                'params' => [
                    param => value,
                    param => value,
                    param => value
                ]
            ],
            'textarea2' => ['disabled' => true]
        ]
    ];

The resulting controller vars:

    $editor = $overrides['News']['editor']; // CKEditor
    $editor = $overrides['PostCalendar']['editor']; // not set

There are also used several 'standard' modvars in use.
