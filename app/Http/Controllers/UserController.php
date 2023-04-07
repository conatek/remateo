<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() 
    {
        $users = User::all();
        // $users = User::paginate(2);
        // $users = \DB::table('users')->simplePaginate(2);
        return view('back.users.index', compact('users'));
    }
    
    public function create()
    {
        return view('back.users.create');
    }

    public function store(Request $request)
    {
        
        User::create($request->only('name', 'email')
            + [
                'password' => bcrypt($request->input('password')),
            ]);
        return redirect()->route('users.index')->with('success', 'Usuario creado exitosamente!');
    }

    public function show(User $user)
    {
        return view('back.users.show', compact('user'));
    }
}
