<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\UserProfile;
use App\Friend;

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

        return view('home', ['name' => $user->name,
                             'profile' => $profile->profile,
                             'friends' => $friends
                             ]);
    }

    public function edit()
    {
        $user = Auth::user();
        \Debugbar::info($user);

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
        
        \Debugbar::info($user);

        // $this->Validate($request, UserProfile::$rules);

        $form = $request->all();
        unset($form['_token']);
        \Debugbar::info($form);
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
