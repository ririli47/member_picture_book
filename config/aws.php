<?php

return [
    'user_image' => [
        'region' => 'ap-northeast-1',
        'url' => env('AWS_S3_BUCKET_USER_IMAGE_URL', ''),
        'bucket' => env('AWS_S3_BUCKET_USER_IMAGE', ''),
        'key' => [
            'access' => env('AWS_KEY_ACCESS', ''),
            'secret' => env('AWS_KEY_SECRET', ''),
        ]
    ],
];
