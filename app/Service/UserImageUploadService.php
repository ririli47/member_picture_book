<?php

namespace App\Service;

use App\Libs\Aws\Storage\UserImage\UserImageClient;
use App\Libs\Aws\Storage\UserImage\UserImageUploadRequest;
use App\Libs\Images\UserImageResize;
use App\User;

class UserImageUploadService
{
    public function upload(User $user, \SplFileInfo $imageUploaded): bool
    {
        // resize image
        $imageResized = (new UserImageResize)->resize($imageUploaded);

        try {
            $request = new UserImageUploadRequest($user, $imageResized);
            $result = (new UserImageClient)->upload($request);

            return $result->isSucceed();
        } catch (\Throwable $e) {
            // TODO: 自力で回復の余地なし
            logs()->error($e->getMessage());
            throw $e;
        } finally {
            if (!@unlink($imageUploaded->getRealPath())) {
                logs()->error("");
            }
            if (!@unlink($imageResized->getRealPath())) {
                logs()->error("");
            }
        }
    }
}