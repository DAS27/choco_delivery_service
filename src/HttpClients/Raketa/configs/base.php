<?php

declare(strict_types=1);

return [
    'token' => env('CHOCO_DOSTAVKA_TOKEN'),
    'refresh_token' => env('CHOCO_DOSTAVKA_REFRESH_TOKEN'),
    'prod' => [
        'api_url' => env('CHOCO_DOSTAVKA_API_URL'),
    ],
    'dev' => [
        'api_url' => env('CHOCO_DOSTAVKA_DEV_API_URL'),
    ],
];
