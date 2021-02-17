<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('email', $request->input('email'))->first();

        if($user != null) {
            $check = Hash::check($request->input('password'), $user->password);
            if($check) {
                return response()->json($user);
            }
        }

        return response()->json(false);
    }
}
