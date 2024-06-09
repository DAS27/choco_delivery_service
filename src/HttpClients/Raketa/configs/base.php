<?php

declare(strict_types=1);

return [
    'prod' => [
        'token' => env('CHOCO_DOSTAVKA_TOKEN'),
        'api_url' => env('CHOCO_DOSTAVKA_API_URL'),
    ],
    'dev' => [
        'token' => env('CHOCO_DOSTAVKA_DEV_TOKEN'),
        'api_url' => env('CHOCO_DOSTAVKA_DEV_API_URL'),
    ],
];
