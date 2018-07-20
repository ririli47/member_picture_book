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

        //idだけ
        $friend_ids = Friend::where('user_id', $user->id)->get();

        $friends = Array();
        foreach($friend_ids as $id) {
            $friends[] = User::where('id', $id->friend_id)->first();
        }

        $members = User::orderBy('name')->get();

        return view('friend.edit', ['user_id' => $user->id,
                                    'friends' => $friends,
                                    'members' => $members
                                    ]);
    }

    public function update(Request $request)
    {
        $friend = Friend::query()->where('user_id', $request->user_id)->first();


        unset($form['_token']);
        $friend->fill($form)->save();
        return redirect('/');
    }

    public function delete(Request $request) {
        $delete_terget = Friend::where('friend_id', $request->friends)
                                ->where('user_id', $request->user_id)
                                ->delete();

        // if(!$delete_terget)
        // {
        //     redirect('/');
        // }
    }

    public function create(Request $request) {

        $friend = new Friend;

        $form = $request->all();
        unset($form['_token']);

        $friend->fill($form)->save();
        return redirect('/friend/edit');
    }
}
