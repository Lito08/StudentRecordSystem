<?php

use App\Models\{User, Student, Course};

test('admin can enrol a student in a course', function () {
    // Arrange
    $admin   = User::factory()->create()->assignRole('admin');
    $student = Student::factory()->create();
    $course  = Course::factory()->create();

    // Act
    $this->actingAs($admin)
         ->post(route('enrolments.store', $course), [
             'student_ids' => [$student->id],
         ])->assertRedirect();

    // Assert
    expect($course->students()->whereKey($student->id)->exists())->toBeTrue();
});
