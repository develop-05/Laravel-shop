<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::query()->get();
        return view('admin.user.index', compact('users'));
    }

    public function create()  // форма створення
    {
        return view('admin.user.create');
    }

    public function store(Request $request) // збереження
    {
        $validated = $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:6'],
            'is_admin' => ['boolean'],
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->is_admin = $request->boolean('is_admin');
        $user->save();
        return redirect()->route('admin.users.index');
    }

    public function show($id) // перегляд одного
    {}

    public function edit($id) // форма редагування
    {
        $user = User::query()->findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, string $id) // оновлення
    {
        $user = User::query()->findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $id],
            'password' => ['nullable', 'confirmed', 'min:6'],
            'is_admin' => ['boolean'],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->is_admin = $request->boolean('is_admin');
        if($request->filled('password')) {
            $user->password = $request->password;
        }
        $user->save();

        return redirect()->route('admin.users.index');
    }

    public function destroy($id) // видалення
    {
        $user = User::query()->findOrFail($id);

        if($user->id == auth()->user()->id) {
            return redirect()->route('users.index')->with('error', 'Error you cant delete your profile');
        }
        $user->delete();
        return redirect()->route('admin.users.index');
    }
}
