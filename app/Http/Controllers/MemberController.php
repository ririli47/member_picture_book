<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\UserProfile;
use App\Friend;
use App\Interest;

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

        return view('member.home', ['name' => $member->name,
                                    'member_id' => $member->id,
                                    'profile' => $profile->profile,
                                    'friends' => $friends
                                    ]);
    }

    public function interest(Request $request)
    {
        $user = Auth::user();

        $member = User::find($request->id);

        
        return view('member.interest', ['member' => $member,
                                        'user' => $user
                                        ]);
    }

    public function create(Request $request)
    {
        $interest = new Interest;

        $form = $request->all();
        
        unset($form['_token']);
        $interest->fill($form)->save();

        return redirect('/');
    }
}
