<?php

namespace App\Libs\Images;
use Intervention\Image\ImageManager;

class UserImageResize
{
    public function resize(\SplFileInfo $imageSource): \SplFileInfo
    {
        $imageDestination = tempnam(sys_get_temp_dir(), '');

        (new ImageManager())
            ->make($imageSource->getRealPath())
            ->fit(256, 256)
            // 本当はjpegにしたいがdockerが対応していない...
            //->encode('jpg', 90)
            ->encode('png', 90)
            ->save($imageDestination);

        return new \SplFileInfo($imageDestination);
    }
}

