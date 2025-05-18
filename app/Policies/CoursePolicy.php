<?php

namespace App\Policies;

use App\Models\{User, Course};

class CoursePolicy
{
    /**
     * Determine whether the user can view any courses (the index page).
     */
    public function viewAny(User $user): bool
    {
        // admins and lecturers can list courses
        return $user->hasRole('admin') || $user->hasRole('lecturer');
    }

    /**
     * Determine whether the user can view a single course (grades page).
     */
    public function view(User $user, Course $course): bool
    {
        if ($user->hasRole('admin')) {
            return true;
        }

        if ($user->hasRole('lecturer')) {
            // allow if unassigned or owned by this lecturer
            return $course->lecturer_id === null
                || (int) $course->lecturer_id === $user->id;
        }

        return false;   // students / others
    }

    /**
     * Determine whether the user can create courses.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can update the course.
     */
    public function update(User $user, Course $course): bool
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can delete the course.
     */
    public function delete(User $user, Course $course): bool
    {
        return $user->hasRole('admin');
    }
}
