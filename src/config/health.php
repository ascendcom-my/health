<?php

return [

    'register-events' => false,

    'stacks' => [

        'quick-diagnose' => [
    
            'checks' => [
                Bigmom\Health\Checks\DatabaseCheck::class,
                Bigmom\Health\Checks\CacheCheck::class,
            ],
    
            'handlers' => [
                Bigmom\Health\Handlers\LogHandler::class,
                // Bigmom\Health\Handlers\BroadcastHandler::class,
            ],
    
        ],

    ],

];
