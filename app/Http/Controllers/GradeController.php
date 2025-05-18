<?php

namespace App\Http\Controllers;

use App\Models\{Course, Grade, Student};
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * @method void authorize(string|array $ability, mixed $arguments = [])
     */
    public function index(Course $course)
    {
        $this->authorize('view', $course);
        $grades   = Grade::with('student')
                     ->where('course_id', $course->id)->get();
        $students = Student::orderBy('name')->get(); // for add-grade form
        return view('grades.index', compact('course','grades','students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Course $course)
    {
        $data = $request->validate([
            'student_id' => 'required|exists:students,id',
            'grade'      => 'required|string|in:A,B,C,D,F', // tighter rule (optional)
        ]);

        Grade::updateOrCreate(
            ['course_id' => $course->id, 'student_id' => $data['student_id']],
            ['grade'     => $data['grade']],
        );

        return redirect()->route('grades.index', $course)->with('success', 'Grade saved');
    }

    /** Student’s own dashboard */
    public function studentView()
    {
        $student = auth()->user()->student;
        abort_if(!$student, 403);

        $grades = Grade::with('course')
                ->where('student_id', $student->id)->get();

        return view('grades.my', compact('grades'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Grade $grade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Grade $grade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Grade $grade)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grade $grade)
    {
        //
    }
}
