<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserTagAdd;
use App\Http\Requests\UserTagRemove;
use App\Service\TagService;
use App\User;
use App\UserTag;

class TagController extends Controller
{
    public function add(UserTagAdd $request)
    {
        $user = User::findById($request->get('user_id'));
        $tagName = $request->get('tag_name');

        try {
            $tag = (new TagService)->addToUser($user, $request->get('tag_name'));
            session()->flash('message_success', sprintf('success to add tag: %s', $tagName));
        } catch (\Throwable $e) {
            logs()->error($e->getMessage());
            return redirect()->back()->withErrors([
                sprintf('failed to add tag: %s', $tagName)
            ]);
        }

        return redirect()->route('member/home', ['id' => $user->getId()]);
    }

    public function remove(UserTagRemove $request)
    {
        $userTag = UserTag::findById($request->get('user_tag_id'));
        $user = User::findById($userTag->getUserId());

        try {
            (new TagService)->removeFromUser($userTag);
            session()->flash('message_success', 'remove succeed');
        } catch (\Throwable $e) {
            logs()->error($e->getMessage());
            return redirect()->back()->withErrors([
                sprintf('failed to remove tag')
            ]);
        }

        return redirect()->route('member/home', ['id' => $user->getId()]);
    }
}
