<?php

namespace App\Http\Controllers;

use App\Models\Rank;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register()
    {
        $ranks = Rank::all();

        return view('auth.register',compact('ranks'));
    }
}
