<?php

namespace App\Service;

use App\Tag;
use App\User;
use App\UserTag;

class TagService
{
    /**
     * @param User $user
     * @param string $tagName
     * @return Tag
     */
    public function addToUser(User $user, string $tagName): Tag
    {
        return \DB::transaction(function () use ($user, $tagName) {
            $tag = Tag::findOrCreateByName($tagName);
            (new UserTag([
                'user_id' => $user->getId(),
                'tag_id' => $tag->getId(),
            ]))->save();
            return $tag;
        });
    }

    /**
     * @param UserTag $userTag
     * @return bool
     */
    public function removeFromUser(UserTag $userTag): bool
    {
        \DB::transaction(function () use ($userTag) {
            if (!$userTag->delete()) {
                throw new \RuntimeException('failed to delete user_tag');
            }
            if (0 === UserTag::query()->where('tag_id', $userTag->getTagId())->count()) {
                // 該当タグの所有者が0ならTag自体も削除する
                Tag::findById($userTag->getTagId())->delete();
            }
        });
        return true;
    }
}

