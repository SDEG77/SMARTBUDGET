<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class AdminCategoryController extends Controller
{
    public function index() {
        return view('admin.categories.index', ['categories' => Category::all()]);
    }
    public function create(Request $request) {
        return view('admin.categories.create');
    }
    public function edit(Request $request) {
        return view('admin.categories.edit');
    }
}
