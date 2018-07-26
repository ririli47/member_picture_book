<?php

namespace App\Libs\Aws\Storage\UserImage;

use Aws\Result;

class UserImageUploadResult
{
    private $data = [];
    private $key;

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    public function withKey(string $key): self
    {
        $this->key = $key;
        return $this;
    }

    public function __construct(Result $result)
    {
        $this->data = $result->toArray();
    }
    
    public function isSucceed(): bool
    {
        return 200 == $this->data['@metadata']['statusCode'];
    }


}

