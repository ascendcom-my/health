<?php

use Bigmom\Health\Checks\DatabaseCheck;
use Bigmom\Health\Handlers\LogHandler;

return [
    
    'quick-diagnose' => [

        'checks' => [
            DatabaseCheck::class,
        ],

        'handlers' => [
            LogHandler::class,
        ],

    ],

];
