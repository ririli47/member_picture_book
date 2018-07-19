<?php

namespace App\Libs\Aws\Storage\UserImage;

use App\User;

class UserImageUploadRequest
{
    /**
     * @var \SplFileInfo
     */
    private $file;

    /**
     * @var User
     */
    private $user;

    public function __construct(User $user, \SplFileInfo $splFileInfo)
    {
        $this->file = $splFileInfo;
        $this->user = $user;
    }

    public function getArgs(): array
    {
        return [
            'Bucket' => config('aws.user_image.bucket'),
            'Key'    => $this->resolveKey(),
            'SourceFile' => $this->file->getRealPath(),
            'ACL'    => 'public-read',
            'ContentType' => mime_content_type($this->file->getRealPath()),
        ];
    }

    private function resolveKey(): string
    {
        return 'userimage.png';
    }
}
