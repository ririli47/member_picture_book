<?php

namespace App\Libs\Aws\Storage\UserImage;

use App\Libs\Aws\AwsClientFactory;
use Aws\S3\Exception\S3Exception;

class UserImageClient
{
    /**
     * @param UserImageUploadRequest $imageUploadRequest
     *
     * @throws S3Exception
     *
     * @return UserImageUploadResult
     */
    public function upload(UserImageUploadRequest $imageUploadRequest): UserImageUploadResult
    {
        $s3Client = AwsClientFactory::createS3ClientForUserImage();

        $result = $s3Client->putObject($imageUploadRequest->getArgs());

        // TODO: $result をなんとかする

        return new UserImageUploadResult();
    }
}

