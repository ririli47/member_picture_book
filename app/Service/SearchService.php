<?php

namespace App\Service;

use App\Tag;
use App\User;
use App\UserTag;

class SearchService
{
    static function searchByTag(string $tagName)
    {
        $tag = Tag::findByName($tagName);

        $user_ids = UserTag::where('tag_id', $tag['id'])->get(['user_id']);
        
        return $user_ids;
    }
    
    static function searchByUserName(string $userName)
    {
        $user_ids = User::where('name', $userName)->get(['id']);

        return $user_ids;
    }
}