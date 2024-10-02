<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.users.index', ['users' => User::all()]);
    }
    
    public function delete(Request $request, User $user)
    {
        User::where('id', $request->input('id'))->delete();

        return to_route('admin.users.index');
    }
}
