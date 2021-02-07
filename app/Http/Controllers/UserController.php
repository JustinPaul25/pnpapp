<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Rank;
use App\Types\RoleType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\User as UserResource;

class UserController extends Controller
{
    public function list(Request $request)
    {
        $users = User::query();
        // if($request->filled('search')) {
        //     $users = User::where('name', 'LIKE', '%'.$request->input('search').'%')
        //     ->orWhere('username', 'LIKE', '%'.$request->input('search').'%');
        // }
        // if($request->filled('role')) {
        //     if($request->input('role') == "Administrator") {
        //         $users = $users->role('Administrator');
        //     } else if ($request->input('role') == "Mid") {
        //         $users = $users->role('Mid');
        //     } else {
        //         $users = $users->role('Viewonly');
        //     }
        // }
        
        $users = $users->paginate(20);
        return new UserCollection($users);
    }

    public function store(Request $request)
    {
        $user = User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'mobile_no' => $request->input('mobile_no'),
            'rank_id' => $request->input('rank_id'),
            'description' => $request->input('description'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        if($request->input('role') == 'Administrator') {
            $user->assignRole(RoleType::ADMIN);
        }else if($request->input('role') == 'Police Administrator') {
            $user->assignRole(RoleType::POLICEADMIN);
        } else if($request->input('role') == 'Barangay Administrator') {
            $user->assignRole(RoleType::BRGYADMIN);
        } else {
            $user->assignRole(RoleType::COMPLAINANT);
        }

        return $user;
    }

    public function detail()
    {
        return new UserResource(auth()->user());
    }
}
