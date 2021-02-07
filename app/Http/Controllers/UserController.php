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
    public function checkMail(Request $request)
    {
        if($request->input('is_edit') == 1) {
            $user = User::where('email', '=', $request->input('email'))->first();
            if ($user) {
                if($user->id != $request->input('id')) {
                    return response()->json(true);
                }
            }
        } else {
            if (User::where('email', '=', $request->input('email'))->exists()) {
                return response()->json(true);
            }
        }
        return response()->json(false); 
    }

    public function list(Request $request)
    {
        $users = User::query();
        if($request->filled('search')) {
            $search = $request->input('search');
            if($request->filled('rank_id') && $request->input('role') == "Police Administrator") {
                $users = User::where('rank_id', $request->input('rank_id'))
                ->where(function($query) use ($search) {
                    $query->where('first_name', 'LIKE', '%'.$search.'%')
                    ->orWhere('last_name', 'LIKE', '%'.$search.'%')
                    ->orWhere('email', 'LIKE', '%'.$search.'%');	
                });
            } else {
                $users = User::where(function($query) use ($search) {
                    $query->where('first_name', 'LIKE', '%'.$search.'%')
                    ->orWhere('last_name', 'LIKE', '%'.$search.'%')
                    ->orWhere('email', 'LIKE', '%'.$search.'%');	
                });
            }
        } else {
            if ($request->filled('rank_id') && $request->input('role') == "Police Administrator") {
                $users = User::where('rank_id', $request->input('rank_id'));
            }
        }

        if( $request->filled('role')) {
            if($request->input('role') == "Complainant") {
                $users = $users->role('Complainant');
            } else if ($request->input('role') == "Barangay Administrator") {
                $users = $users->role('Barangay Administrator');
            } else if ($request->input('role') == "Police Administrator") {
                $users = $users->role('Police Administrator');
            } else {
                $users = $users->role('Administrator');
            }
        }
        
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
            'birth_Date' => $request->input('birth_date'),
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

    public function update(User $user, Request $request)
    {
        $user->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'mobile_no' => $request->input('mobile_no'),
            'rank_id' => $request->input('role') == 'Police Administrator' ? $request->input('rank_id') : null,
            'description' => $request->input('description'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'birth_Date' => $request->input('birth_date'),
        ]);

        if($request->input('role') == 'Administrator') {
            $user->syncRoles([RoleType::ADMIN]);
        }else if($request->input('role') == 'Police Administrator') {
            $user->syncRoles([RoleType::POLICEADMIN]);
        } else if($request->input('role') == 'Barangay Administrator') {
            $user->syncRoles([RoleType::BRGYADMIN]);
        } else {
            $user->syncRoles([RoleType::COMPLAINANT]);
        }

        return response()->json($user);
    }

    public function detail()
    {
        return new UserResource(auth()->user());
    }
}
