<?php

return [
    'files' => [
        'allowed_extensions' => [
            'jar', 'zip', 'rar', 'tar.gz', 'tar'
        ]
    ],
    'fee' => 5,
    'hcaptcha' => [
        'public_key' => env('HCAPTCHA_PUBLIC_KEY', '5c123643-0349-474e-a131-30368a03f91c'),
        'secret_key' => env('HCAPTCHA_SECRET_KEY')
    ],
    'vt' => [
        'apikey' => 'eb7a47b642b3a3467c60a1e4e0c3b215f71734f2550587d1c25a82c0fb5b6429'
    ]
];