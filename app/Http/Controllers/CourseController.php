<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\User; // lecturers

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        if ($user->hasRole('lecturer')) {
            $courses = Course::where('lecturer_id', $user->id)->paginate(10);
        } else { // admin
            $courses = Course::with('lecturer')->paginate(10);
        }

        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lecturers = User::role('lecturer')->pluck('name', 'id');
        return view('courses.create', ['course'=>new Course(), 'lecturers'=>$lecturers]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'course_name'        => 'required|string|max:255',
            'course_description' => 'nullable|string',
            'lecturer_id'        => 'required|exists:users,id',
        ]);

        Course::create($data);
        return redirect()->route('courses.index')->with('success', 'Course added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $lecturers = User::role('lecturer')->pluck('name', 'id');
        return view('courses.edit', compact('course','lecturers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $data = $request->validate([
            'course_name'        => 'required|string|max:255',
            'course_description' => 'nullable|string',
            'lecturer_id'        => 'required|exists:users,id',
        ]);
        $course->update($data);
        return back()->with('success', 'Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return back()->with('success', 'Deleted');
    }
}
