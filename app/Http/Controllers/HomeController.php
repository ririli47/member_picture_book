<?php

namespace App\Http\Controllers;

use App\Http\Requests\Home\UserProfileImageChange;
use App\Service\UserImageUploadService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\UserProfile;
use App\Friend;
use App\Interest;

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

    public function updateProfileImage(UserProfileImageChange $userProfileImageChange)
    {
        $image = $userProfileImageChange->file('image');

        try {
            (new UserImageUploadService)->upload(Auth::user(), $image);
        } catch (\Throwable $e) {
            dd($e);
            logs()->error($e->getMessage());
            return redirect()->route('home/edit')->with("message_error", "failed");
        }

        return redirect()->route('home/edit')->with("message_success", "success");
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


}
