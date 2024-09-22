<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class LoginUSerController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function store(Request $request){
        $validate = $request->validate([
            'email' => 'required|min:8|email',
            'password' => 'required|min:8|string',
        ]);

        if(Auth::attempt([
            'email' => $validate['email'],
            'password' => $validate['password'],
            ])){

            $request->session()->regenerate();

            return redirect()->intended(route('dashboard'));
        } else {
            return back()->withErrors(['email' => 'Wrong Email!', 'password' => 'Wrong Password!']);
        }
    }

    public function logout(){
        Auth::guard('web')->logout();

        session()->invalidate();
        session()->regenerateToken();

        return to_route('welcome');
    }

    public function resetPass(Request $request, User $user){
        
        $validate = $request->validate([
            'current' => 'required|min:3|string',
            'new' => ['required', 'confirmed', 'min:3', Password::default()],
        ]);

        // if($user->get('password')->where()){
        //     dd('hello');
        //     $user->update(['password' =>  Hash::make($validate['new'])]);
        // }

        return to_route('account.profile');
    }

    public function forgot(){
        return view('auth.forgot');
    }
    public function createPass(){
        return view('auth.createPass');
    }
}
