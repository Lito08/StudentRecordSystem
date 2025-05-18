<?php

namespace App\Policies;

use App\Models\{User, Course};

class CoursePolicy
{
    /**
     * Allow admins to view any course.
     * Allow a lecturer to view a course if lecturer_id matches,
     * or the course is not yet assigned (lecturer_id == null).
     */
    public function view(User $user, Course $course): bool
    {
        if ($user->hasRole('admin')) {
            return true;
        }

        if ($user->hasRole('lecturer')) {
            return $course->lecturer_id === null
                || (int) $course->lecturer_id === $user->id;
        }

        return false;
    }

}
