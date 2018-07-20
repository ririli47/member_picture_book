<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\UserTagAdd;
use App\Http\Requests\UserTagRemove;
use App\Service\TagService;
use App\User;
use App\UserProfile;
use App\Friend;
use App\Interest;
use App\UserTag;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        $profile = UserProfile::where('user_id', $user->id)->first();

        if (!$profile)
        {
            $profile = new UserProfile;
            $profile->$profile = "";
        }

        $friend_ids = Friend::where('user_id', $user->id)->get();

        $friends = Array();
        foreach ($friend_ids as $friend_id)
        {
            $friends[] = User::where('id', $friend_id->friend_id)->first();
        }


        $interested_ids = Interest::where('interest_user_id', $user->id)->get();

        $interested = Array();
        foreach ($interested_ids as $interested_id)
        {
            $interested[] = User::where('id', $interested_id->user_id)->first();
        }

        return view('home', ['name' => $user->name,
                             'user_id' => $user->id,
                             'user' => $user,
                             'profile' => $profile->profile,
                             'friends' => $friends,
                             'interesteds' => $interested
                             ]);
    }

    public function edit()
    {
        $user = Auth::user();

        $profile = UserProfile::where('user_id', $user->id)->first();

        if (!$profile)
        {
            $profile = new UserProfile;
            $profile->$profile = "";
        }

        return view('edit', ['name' => $user->name,
                             'user_id' => $user->id,
                             'profile' => $profile->profile
                             ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        
        $form = $request->all();
        unset($form['_token']);
        $user->fill($form)->save();


        $profile = UserProfile::where('user_id', $user->id)->first();
        if($profile==null)
        {
            UserProfile::create($form);
        }
        else
        {
            $profile->profile = $request->profile;
            $profile->save();
        }

        return redirect('home');
    }

    public function addTag(Request $request) 
    {
        $user = User::findById($request->get('user_id'));
        $tagName = $request->get('tag_name');

        try {
            $tag = (new TagService)->addToUser($user, $request->get('tag_name'));
            session()->flash('message_success', sprintf('success to add tag: %s', $tagName));
        } catch (\Throwable $e) {
            logs()->error($e->getMessage());
            session()->flash('message_alert', sprintf('failed to add tag: %s', $tagName));
        }

        return redirect()->route('home', ['id' => $user->getId()]);
    }


    public function removeTag(UserTagRemove $request)
    {
        $userTag = UserTag::findById($request->get('user_tag_id'));
        $user = User::findById($userTag->getUserId());

        try {
            (new TagService)->removeFromUser($userTag);
        } catch (\Throwable $e) {
            logs()->error($e->getMessage());
            session()->flash('message_alert', sprintf('failed to remove tag'));
        }

        return redirect()->route('home', ['id' => $user->getId()]);
    }

}
