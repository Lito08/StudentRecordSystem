<?php

namespace App\Http\Controllers;

use App\Models\{Course, Student};
use Illuminate\Http\Request;

class EnrolmentController extends Controller
{
    /* attach multiple students */
    public function store(Request $request, Course $course)
    {
        $data = $request->validate([
            'student_ids'   => 'array|required',
            'student_ids.*' => 'exists:students,id',
        ]);

        $course->students()->syncWithoutDetaching(
            collect($data['student_ids'])->mapWithKeys(fn ($id) => [$id => ['status' => 'active']])
        );

        return back()->with('success', 'Students enrolled');
    }

    /* detach one student */
    public function destroy(Course $course, Student $student)
    {
        $course->students()->detach($student->id);
        return back()->with('success', 'Student removed');
    }
}
