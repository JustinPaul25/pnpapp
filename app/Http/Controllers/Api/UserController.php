<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Types\RoleType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
}
