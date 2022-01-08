<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\DataTables\UsersDataTable;

class UserController extends Controller
{
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('pages.users.index');
    }

    public function create()
    {
        return view('pages.users.create');
    }

    public function store(UserRequest $request)
    {
        User::create($request->validated());
        \Session::flash('success','Success|User saved successfully!');
        return redirect()->route('admin.users.index');
    }

    public function show(User $user)
    {
        return view('pages.users.view',compact('user'));
    }

    public function edit(User $user)
    {
        return view('pages.users.edit', ['model'=>$user]);
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $user->updateOrFail($request->validated());
        \Session::flash('success','Success|User updated successfully!');
        return redirect()->route('admin.users.index');
    }

    public function destroy(User $user)
    {
        $user->deleteOrFail();
        \Session::flash('success','Success|User deleted successfully!');
        return redirect()->route('admin.users.index');
    }

}
