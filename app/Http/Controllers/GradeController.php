<?php

namespace App\Http\Controllers;

use App\Models\{Course, Grade, Student};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class GradeController extends Controller
{
    public function sheet(Course $course)
    {
        $this->authorize('view', $course);

        $students = $course->students()->orderBy('name')->get();

        // convert to array so [] accessor works in Blade
        $grades = Grade::where('course_id', $course->id)
                    ->pluck('grade', 'student_id')
                    ->toArray();           //  ← add this

        return view('grades.sheet', compact('course', 'students', 'grades'));
    }

    public function store(Request $request, Course $course)
    {
        $data = $request->validate([
            'student_id' => 'required|exists:students,id',
            'grade'      => 'required|string|in:A,B,C,D,F',
        ]);

        Grade::updateOrCreate(
            ['course_id' => $course->id, 'student_id' => $data['student_id']],
            ['grade'     => $data['grade']]
        );

        return redirect()->route('grades.index', $course)
                         ->with('success', 'Grade saved');
    }

    public function saveSheet(Request $request, Course $course)
    {
        $data = $request->validate([
            'grades'   => 'array',
            'grades.*' => 'nullable|in:A,B,C,D,F',
        ]);

        foreach ($data['grades'] as $studentId => $grade) {
            if ($grade === null || $grade === '') {
                continue;
            }
            Grade::updateOrCreate(
                ['course_id' => $course->id, 'student_id' => $studentId],
                ['grade'     => $grade]
            );
        }

        return back()->with('success', 'Grades updated');
    }

    public function studentView()
    {
        $student = auth()->user()->student;
        abort_if(!$student, 403);

        $grades = Grade::with('course')
                 ->where('student_id', $student->id)->get();

        return view('grades.my', compact('grades'));
    }
}
