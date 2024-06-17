<?php

declare(strict_types=1);

return [
    'base' => [
        'dev' => [
            'api_url' => env('SMART_DEAL_DEV_API_URD'),
        ],
        'prod' => [
            'api_url' => env('SMART_DEAL_API_URD'),
        ],
    ],
];
