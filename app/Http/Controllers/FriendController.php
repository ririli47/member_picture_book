<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Friend;

class FriendController extends Controller
{
    public function edit()
    {
        $user = Auth::user();

        $friends = Friend::where('user_id', $user->id)->get();

        $members = User::orderBy('name')->get();

        return view('friend.edit', ['user_id' => $user->id,
                               'friends' => $friends,
                               'members' => $members
                               ]);
    }

    public function update(Request $request)
    {
        $friend = new Friend;
        $form = $request->all();

        \Debugbar::info($form);

        unset($form['_token']);
        $friend->fill($form)->save();
        return redirect('/');
    }
}