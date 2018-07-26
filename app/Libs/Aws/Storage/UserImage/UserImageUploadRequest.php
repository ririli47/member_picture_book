<?php

namespace App\Libs\Aws\Storage\UserImage;

use App\User;
use Ramsey\Uuid\Uuid;

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

    public function resolveKey(): string
    {
        return sprintf('avatar/%d/%s.png', $this->user->getId(), Uuid::uuid5(Uuid::NAMESPACE_OID, $this->user->getId()));
    }
}
