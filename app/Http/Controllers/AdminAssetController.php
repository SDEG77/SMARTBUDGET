<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminAssetController extends Controller
{
    public function index() {
        return view('admin.index');
    }
    public function admin_logout() {
        Auth::guard('web')->logout();

        session()->invalidate();
        session()->regenerateToken();

        return to_route('login');
    }
}
