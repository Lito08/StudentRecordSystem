<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'user_id',      // ← add this so mass-assignment works
        'name',
        'email',
        'date_of_birth',
        'address',
        'phone',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function grades()  { return $this->hasMany(Grade::class); }
    public function courses() { return $this->belongsToMany(Course::class, Grade::class); }
}

