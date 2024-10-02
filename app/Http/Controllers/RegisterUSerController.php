<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisterUSerController extends Controller
{
    public function register(){
        return view('auth.register');
    }

    public function store(Request $request){
        $validate = $request->validate([
            'name'=> 'required|string|min:3|max:50',
            'email'=> 'required|email|min:12|unique:users',
            'password'=> ['required', 'string', 'confirmed', 'min:8', Password::default()],
        ]);

        $user = User::create([
            'name' => $validate['name'],
            'email' => $validate['email'],
            'password' => Hash::make($validate['password']),
        ]);

        return to_route('login');
    }

    public function congrats(){
        return view('auth.congrats');
    }
}
