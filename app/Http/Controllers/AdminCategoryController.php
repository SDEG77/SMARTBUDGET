<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    public function index() {
        return view('admin.categories.index');
    }
    public function create(Request $request) {
        return view('admin.categories.create');
    }
    public function edit(Request $request) {
        return view('admin.categories.edit');
    }
}
