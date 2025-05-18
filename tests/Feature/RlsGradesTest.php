<?php

use App\Models\{User, Student, Course, Grade};
use Illuminate\Support\Facades\DB;

test('student can only see own grades (RLS)', function () {
    // Arrange: two students, same course
    $course = Course::factory()->create();
    [$s1, $s2] = Student::factory()->count(2)->create();
    Grade::create(['course_id'=>$course->id,'student_id'=>$s1->id,'grade'=>'A']);
    Grade::create(['course_id'=>$course->id,'student_id'=>$s2->id,'grade'=>'B']);

    // Log in as student #1
    $u1 = $s1->user;
    $u1->assignRole('student');
    $this->actingAs($u1);

    // Trigger middleware that sets SESSION_CONTEXT
    $this->get(route('grades.my'))->assertOk();

    // Direct DB query inside app connection (uses same session context)
    $rows = DB::table('grades')->pluck('student_id')->toArray();

    expect($rows)->toBe([$s1->id]);     // only own ID present
});
