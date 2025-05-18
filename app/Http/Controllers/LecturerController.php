<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class LecturerController extends Controller
{
    public function index()
    {
        $lecturers = User::role('lecturer')->paginate(10);
        return view('lecturers.index', compact('lecturers'));
    }

    public function create()
    {
        return view('lecturers.create', [
            'lecturer' => new \App\Models\User()
        ]);
    }

    public function store(Request $r)
    {
        $data = $r->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        $u = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        $u->assignRole('lecturer');

        return redirect()->route('lecturers.index')->with('success','Lecturer added');
    }

    public function edit(User $lecturer)
    {
        return view('lecturers.edit', compact('lecturer'));
    }

    public function update(Request $r, User $lecturer)
    {
        $data = $r->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users,email,'.$lecturer->id,
            'password'=>'nullable|min:8|confirmed',
        ]);
        if($data['password']) $lecturer->password = bcrypt($data['password']);
        $lecturer->update($data);
        return back()->with('success','Updated');
    }

    public function destroy(User $lecturer)
    {
        $lecturer->delete();
        return back()->with('success','Deleted');
    }
}
