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

        //エラーメッセージ用変数
        //GETリクエスト時は空
        $message = '';

        return view('friend.edit', ['user_id' => $user->id,
                                    'friends' => $friends,
                                    'members' => $members,
                                    'message' => $message
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
        $delete_terget = Friend::where('friend_id', $request->friend_id)
                                 ->where('user_id', $request->user_id)
                                 ->first();

        $result = $delete_terget->delete();

        if(!$result)
        {
            return redirect('/');
        }
        else
        {
            return redirect('/friend/edit');
        }
    }

    public function create(Request $request) {

        $make_target = Friend::where('friend_id', $request->friend_id)
                               ->where('user_id', $request->user_id)
                               ->first();

        if($make_target != null) {
            //すでに友達

            //editへのgetと同じ処理...
            //こういうのはサービスに切り出すべきなのかも
            $user = Auth::user();

            //idだけ
            $friend_ids = Friend::where('user_id', $user->id)->get();
    
            $friends = Array();
            foreach($friend_ids as $id) {
                $friends[] = User::where('id', $id->friend_id)->first();
            }
    
            $members = User::orderBy('name')->get();
    

            //エラーメッセージ用文言
            $message = 'already friends!';

            return view('friend.edit', ['user_id' => $user->id,
                                        'friends' => $friends,
                                        'members' => $members,
                                        'message' => $message
                                        ]);

            // return redirect('/friend/edit');
        }

        $friend = new Friend;

        $form = $request->all();
        unset($form['_token']);

        $friend->fill($form)->save();
        return redirect('/friend/edit');
    }
}
