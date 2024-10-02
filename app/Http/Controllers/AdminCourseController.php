<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class AdminCourseController extends Controller
{
    public function index() {
        return view('admin.courses.index', ['courses' => Course::all()]);
    }
    public function create() {
        return view('admin.courses.create');
    }
    public function edit() {
        return view('admin.courses.edit');
    }
}
