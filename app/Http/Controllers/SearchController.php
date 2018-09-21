<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\SearchService;
use App\User;

class SearchController extends Controller
{
    public function search(Request $request) {
        $form = $request->all();
        unset($form['_token']);

        $search_word = $form['word'];

        $member_ids = Array();
        //タグ検索
        $tag_member_ids = SearchService::searchByTag($search_word);
        foreach ($tag_member_ids as $tag_member_id)
        {
            $member_ids[] = $tag_member_id->user_id;
        }
        
        //ユーザー名検索
        $user_member_ids = SearchService::searchByUserName($search_word);
        foreach ($user_member_ids as $user_member_id)
        {
            $member_ids[] = $user_member_id->id;
        }

        $members = Array();
        foreach ($member_ids as $member_id)
        {
            $members[] = User::where('id', $member_id)->first();
        }

        return view('search/result', ['members' => $members]);
    }
}
