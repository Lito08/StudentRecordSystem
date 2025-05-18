<?php

use App\Models\{User, Student};

test('student cannot access the students index route', function () {
    $user     = User::factory()->create()->assignRole('student');
    Student::factory()->create(['user_id' => $user->id]);

    $this->actingAs($user)
         ->get(route('students.index'))
         ->assertForbidden();           // 403
});
