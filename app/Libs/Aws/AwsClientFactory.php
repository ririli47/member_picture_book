<?php

namespace App\Libs\Aws;

use Aws\S3\S3Client;

class AwsClientFactory
{
    public static function createS3ClientForUserImage(): S3Client
    {
        return new S3Client([
            'region'  => config('aws.user_image.region'),
            'version' => 'latest',
            'credentials' => [
                'key'    => config('aws.user_image.key.access'),
                'secret' => config('aws.user_image.key.secret'),
            ]
        ]);
    }
}