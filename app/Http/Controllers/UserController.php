<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserEditRequest;
use App\Models\Company;
use App\Models\User;
// use Cloudinary\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class UserController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_index'), 403);
        $users = User::all();
        return view('back.users.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), 403);
        $companies = Company::all()->pluck('name', 'id');
        $roles = Role::all()->pluck('name', 'id');
        return view('back.users.create', compact('companies', 'roles'));
    }

    public function store(UserCreateRequest $request)
    {
        // Las validaciones se realizan en UserCreateRequest

        $file = request()->file('image');
        $cloudinary_object = Cloudinary::upload($file->getRealPath(), ['folder' => 'mh/' . $request['company_id'] . '/users']);
        $image_public_id = $cloudinary_object->getPublicId();
        $image_url = $cloudinary_object->getSecurePath();

        $user = User::create($request->only('name', 'email', 'company_id')
            + [
                'image_public_id' => $image_public_id,
                'image_url' => $image_url,
                'password' => bcrypt($request->input('password')),
            ]);
        
        $roles = $request->input('roles', []);
        $user->syncRoles($roles);
        return redirect()->route('users.show', $user->id)->with('success', 'Usuario creado exitosamente!');
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), 403);
        $user->load('roles');
        return view('back.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), 403);
        $companies = Company::all()->pluck('name', 'id');
        $roles = Role::all()->pluck('name', 'id');
        $user->load('roles');
        return view('back.users.edit', compact('user', 'companies', 'roles'));
    }

    public function update(UserEditRequest $request, User $user)
    {
        // Las validaciones se realizan en UserEditRequest

        $data = $request->only('name', 'email', 'company_id');
        $password = $request->input('password');
        if($password) {
            $data['password'] = bcrypt($password);
        }
        
        $url = $user['image_url'];
        $public_id = $user['image_public_id'];
        if($request->hasFile('image')) {
            Cloudinary::destroy($public_id);
            $file = request()->file('image');
            $cloudinary_object = Cloudinary::upload($file->getRealPath(), ['folder' => 'mh/' . $request['company_id'] . '/users']);
            $image_public_id = $cloudinary_object->getPublicId();
            $image_url = $cloudinary_object->getSecurePath();

            $data['image_public_id'] = $image_public_id;
            $data['image_url'] = $image_url;
        } else {
            $data['image_public_id'] = $public_id;
            $data['image_url'] = $url;
        }

        $user->update($data);
        $roles = $request->input('roles', []);
        $user->syncRoles($roles);
        return redirect()->route('users.show', $user->id)->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_destroy'), 403);
        if(auth()->user()->id == $user->id) {
            return redirect()->route('users.index');
        }

        $public_id = $user['image_public_id'];
        Cloudinary::destroy($public_id);
        $user->delete();
        return back()->with('success', 'Usuario eliminado correctamente.');
    }
}
