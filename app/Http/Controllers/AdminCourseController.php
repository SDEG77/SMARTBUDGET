<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminCourseController extends Controller
{
    public function index() {
        return view('admin.courses.index');
    }
    public function create() {
        return view('admin.courses.create');
    }
    public function edit() {
        return view('admin.courses.edit');
    }
}
