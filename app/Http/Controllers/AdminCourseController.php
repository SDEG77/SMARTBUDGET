<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class AdminCourseController extends Controller
{
    public function index() {
        return view('admin.courses.index', [
            'courses' => Course::all()->sortBy('course')
        ]);
    }

    public function create() {
        return view('admin.courses.create');
    }

    public function store(Request $request) {
        $request->merge([
            'course' => strip_tags($request->input('course')),
        ]);

        $validated = $request->validate([
            'course' => 'required|string|min:3'
        ]);

        Course::create($validated);

        return to_route('admin.courses.index');
    }

    public function edit(Course $course) {
        return view('admin.courses.edit', ['course' => $course]);
    }

    public function update(Request $request, Course $course) {
        $request->merge([
            'course' => strip_tags($request->input('course')),
        ]);

        $validated = $request->validate([
            'course' => 'required|string|min:3'
        ]);

        $course->update($validated);

        return to_route('admin.courses.index');
    }

    public function delete(Course $course) {
        $course->delete();

        return to_route('admin.courses.index');
    }
}
