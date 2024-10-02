<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    public function index() {
        return view('auth.categories.index');
    }
    public function create(Request $request) {
        return view('auth.categories.create');
    }
    public function edit(Request $request) {
        return view('auth.categories.edit');
    }
}
