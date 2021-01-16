<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function index(){
        return view("users");
    }
    
    public function show(User $user){
        return view("users.show")->with('user', $user);
    }

    public function add(Request $request){
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \bcrypt('password'), //default password for new users
            'role' => $request->role,
        ]);


        return redirect()->route('users');
    }


}