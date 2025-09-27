<?php
return [

    // ... other HTTP config

    'cors' => [
        'paths' => ['api/*', 'sanctum/csrf-cookie'],
        'allowed_methods' => ['*'],
        'allowed_origins' => ['*'],  // 👈 allow all domains
        'allowed_headers' => ['*'],  // 👈 allow all headers
        'exposed_headers' => [],
        'max_age' => 0,
        'supports_credentials' => false,
    ],

];
