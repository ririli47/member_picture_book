<?php

namespace App\Http\Controllers;

use App\Http\Requests\Home\UserProfileImageChange;
use App\Service\UserImageUploadService;
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
                             'profile' => $profile,
                             'user' => $user,
                             'friends' => $friends,
                             'interesteds' => $interested
                             ]);
    }

    public function edit()
    {
        /** @var User $user */
        $user = Auth::user();

        $profile = $user->getProfile();

        return view('edit', ['name' => $user->name,
                             'user_id' => $user->id,
                             'profile' => $profile,
                             ]);
    }

    public function updateProfileImage(UserProfileImageChange $userProfileImageChange)
    {
        $image = $userProfileImageChange->file('image');

        try {
            (new UserImageUploadService)->upload(Auth::user(), $image);
            session()->flash("message_success", "success uploading image");
        } catch (\Throwable $e) {
            logs()->error($e->getMessage());
            return redirect()->route('home/edit')->withErrors([
                "failed to upload user image"
            ]);
        }

        return redirect()->route('home/edit');
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
        session()->flash("message_success", "success edit");

        return redirect()->route('home/edit');
    }

    public function addTag(Request $request) 
    {
        $user = Auth::User();

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

        return redirect()->route('home');
    }


    public function removeTag(UserTagRemove $request)
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

        return redirect()->route('home');
    }

}
