<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserProfile;
use App\Friend;

class MemberController extends Controller
{
    public function index()
    {
        $members = User::orderBy('name')->get();

        return view('welcome', ['members' => $members]);
    }

    public function show(Request $request)
    {









        $member = User::find($request->id);

        $profile = UserProfile::where('user_id', $member->id)->first();
        if (!$profile)
        {
            $profile = new UserProfile;
            $profile->$profile = "";
        }

        $friend_ids = Friend::where('user_id', $member->id)->get();

        $friends = Array();
        foreach ($friend_ids as $friend_id)
        {
            $friends[] = User::where('id', $friend_id->friend_id)->first();
        }

        return view('home', ['name' => $member->name,
                             'profile' => $profile->profile,
                             'friends' => $friends
                             ]);
    }
}
