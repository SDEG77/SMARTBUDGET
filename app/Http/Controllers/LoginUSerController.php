<?php

namespace App\Http\Controllers;

use App\Mail\UserMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

class LoginUSerController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function store(Request $request){
        $request->merge([
            'email' => strip_tags($request->email),
            'password' => strip_tags($request->password)
        ]);

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

    public function forgot(){
        return view('auth.forgot');
    }
    public function createPass(){
        return view('auth.createPass');
    }

    public function changePass(Request $request, User $user){
        // dd($request);

        $request->merge([
            'current_password' => strip_tags($request->current_password),
            'new_password' => strip_tags($request->new_password),
        ]);

        // dd($request);

        $validated = $request->validate([
            'current_password' => 'required|string|min:8',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        // dd($validated);

        if(!Hash::check($validated['current_password'], auth()->user()->password)){
            return back()->withErrors(['current_password' => 'Current password does not match the original']);
        }

        Auth::user()->update([
            'password' => Hash::make($validated['new_password'])
        ]);

        return to_route('account.profile');
    }

    public function updateInfo(Request $request, User $user){
        // dd($request);
        
        $request->merge([
            'full_name' => strip_tags($request->input('full_name')),
            'email' => strip_tags($request->input('email')),
            'school_name' => strip_tags($request->input('school_name')),
            'course' => strip_tags($request->input('course')),
        ]);

        $validated = $request->validate([
            'full_name' => 'required|string|min:3',
            'email' => 'required|email|min:8|unique:users,email,' . auth()->user()->id,
            'school_name' => 'required|string|min:3',
            'course' => 'required|string|min:3',
        ]);

        $user->where('id', auth()->user()->id)->update($validated);

        return to_route('account.profile');
    }

    public function updatePic(Request $request, User $user){
        $old = auth()->user()->profile_pic; // Assuming you store the path in the user's profile_pic field
        if ($old) {
            Storage::disk('public')->delete($old);
        }

        // dd($request->profile_pic);
        $validated = $request->validate([
            'profile_pic' => 'required|image|mimes:jpeg,jpg,png|max:25600'
        ]);


        // dd($validated);
        $validated['profile_pic'] = $request->file('profile_pic')->store('profile_pics', 'public');
        // dd($validated);


        Auth::user()->update([
            'profile_pic' => $validated['profile_pic']
        ]);

        return to_route('account.profile');
    }

    public function suicide(){
        if(auth()->user()){
            auth()->user()->delete();
            session()->invalidate();
            session()->regenerateToken();

            return to_route('welcome');
        } else {
            return to_route('welcome');
        }
    }

    public function forgor(Request $request){
        // dd($request);
        $request->merge([
            'email' => strip_tags($request->email)
        ]);
        // dd($request);
        
        $validated = $request->validate([
            'email' => 'required|email|min:6'
        ]);
        // dd($validated);

        if(User::where('email', $validated['email'])->exists()){
            // dd(new UserMail(['email' => $validated['email']]));
            Mail::to($validated['email'])->send(new UserMail(['email' => $validated['email']]));

            return to_route('register');
        }

        // dd('This does not work');
        return back()->withErrors(['email' => 'No email found in database']);
    }

    public function storePass(){
        return view('welcome');
    }

    public function email() {
        return view('forgot');
    }
}
