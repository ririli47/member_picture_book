<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class MemberController extends Controller
{
    public function index()
    {
        $members = User::orderBy('name')->get();

        return view('welcome', ['members' => $members]);
    }
}
