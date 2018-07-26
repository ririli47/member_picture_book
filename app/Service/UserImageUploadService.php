<?php

namespace App\Service;

use App\Libs\Aws\Storage\UserImage\UserImageClient;
use App\Libs\Aws\Storage\UserImage\UserImageUploadRequest;
use App\Libs\Images\UserImageResize;
use App\User;

class UserImageUploadService
{
    /**
     * ユーザー画像をリサイズしてDB+storageへ保存する
     *
     * @param User $user
     * @param \SplFileInfo $imageUploaded
     * @return bool
     * @throws \Throwable
     */
    public function upload(User $user, \SplFileInfo $imageUploaded): bool
    {
        // resize image
        $imageResized = (new UserImageResize)->resize($imageUploaded);

        try {
            $request = new UserImageUploadRequest($user, $imageResized);
            $result = (new UserImageClient)->upload($request);

            if (!$user->getProfile()->fill([
               'avatar_path' => $result->getKey(),
            ])->save()) {
                throw new \RuntimeException('failed to save user profile');
            }

            return $result->isSucceed();
        } catch (\Throwable $e) {
            logs()->error($e->getMessage());
            throw $e;
        } finally {
            if (!@unlink($imageResized->getRealPath())) {
                logs()->error("failed to delete resize image:" . $imageResized->getRealPath());
            }
        }
    }
}