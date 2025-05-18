<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /* ─── Mass-assignable columns ───────────────────────────── */
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'date_of_birth',
        'address',
        'phone',
    ];

    /* ─── Relationships ─────────────────────────────────────── */

    /** 1-to-1 link back to the user record */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /** 1-to-many: all grade rows for this student */
    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    /**
     * Many-to-many: courses the student is enrolled in.
     * Uses the enrolments pivot table (student_id, course_id, status, timestamps).
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'enrolments')
                    ->withPivot('status')
                    ->withTimestamps();
    }
}
