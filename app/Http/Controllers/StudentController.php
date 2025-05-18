<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::latest()->paginate(10);
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('students.create', ['student' => new Student()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
        'name'  => 'required|string|max:255',
        'email' => 'required|email|unique:students|unique:users',
        'date_of_birth' => 'nullable|date',
        'address'       => 'nullable|string',
        'phone'         => 'nullable|string|max:20',
        'password'      => 'required|min:8|confirmed',   // NEW
    ]);

    // 1. create User
    $user = User::create([
        'name'     => $data['name'],
        'email'    => $data['email'],
        'password' => bcrypt($data['password']),
    ]);
    $user->assignRole('student');

    // 2. create Student and link
    $student = Student::create([
        'user_id'       => $user->id,
        'name'          => $data['name'],
        'email'         => $data['email'],
        'date_of_birth' => $data['date_of_birth'] ?? null,
        'address'       => $data['address'] ?? null,
        'phone'         => $data['phone'] ?? null,
    ]);

    return redirect()->route('students.index')->with('success','Student created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $data = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,'.$student->id.'|unique:users,email,'.$student->user_id,
            'date_of_birth' => 'nullable|date',
            'address'       => 'nullable|string',
            'phone'         => 'nullable|string|max:20',
            'password'      => 'nullable|min:8|confirmed',
        ]);

        $user = $student->user;
        if (!$user) {
            $user = User::create([
                'name'     => $data['name'],
                'email'    => $data['email'],
                'password' => bcrypt(Str::random(12)),   // temp random pw
            ]);
            $user->assignRole('student');
            $student->user()->associate($user);          // set user_id
        }

        // 2. Update the user
        $user->name  = $data['name'];
        $user->email = $data['email'];
        if (!empty($data['password'])) {
            $user->password = bcrypt($data['password']);
        }
        $user->save();

        // 3. Update the student
        $student->update($data);

        return back()->with('success', 'Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return back()->with('success', 'Deleted');
    }
}
