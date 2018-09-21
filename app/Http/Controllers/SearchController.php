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

        $member_ids = SearchService::searchByTag($form['word']);

        $members = Array();
        foreach ($member_ids as $member_id)
        {
            $members[] = User::where('id', $member_id->user_id)->first();
        }



        return view('search/result', ['members' => $members]);
    }
}
