<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Types\RoleType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $user = User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'mobile_no' => $request->input('mobile_no'),
            'description' => $request->input('description'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'birth_Date' => $request->input('birth_date'),
        ]);
            
        $user->assignRole(RoleType::COMPLAINANT);

        return $user;
    }

    public function logout(Request $request)
    {
        // Revoke a specific user token
        Auth::user()->tokens()->where('id', $request->input('id'))->delete();
        // Get user who requested the logout
        $user = request()->user(); //or Auth::user()
        // Revoke current user token
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();

        return;
    }
}
