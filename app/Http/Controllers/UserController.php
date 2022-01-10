<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Session;
use Throwable;

class UserController extends Controller
{
    /**
     * @param UsersDataTable $dataTable
     * @return mixed
     */
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('pages.users.index');
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('pages.users.create');
    }

    /**
     * @param UserRequest $request
     * @return RedirectResponse
     */
    public function store(UserRequest $request): RedirectResponse
    {
        User::create($request->validated());
        Session::flash('success', 'Success|User saved successfully!');
        return redirect()->route('admin.users.index');
    }

    /**
     * @param User $user
     * @return Application|Factory|View
     */
    public function show(User $user)
    {
        return view('pages.users.view', compact('user'));
    }

    /**
     * @param User $user
     * @return Application|Factory|View
     */
    public function edit(User $user)
    {
        return view('pages.users.edit', ['model' => $user]);
    }

    /**
     * @param UserUpdateRequest $request
     * @param User $user
     * @return RedirectResponse
     * @throws Throwable
     */
    public function update(UserUpdateRequest $request, User $user): RedirectResponse
    {
        $user->updateOrFail($request->validated());
        Session::flash('success', 'Success|User updated successfully!');
        return redirect()->route('admin.users.index');
    }

    /**
     * @param User $user
     * @return RedirectResponse
     * @throws Throwable
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->deleteOrFail();
        Session::flash('success', 'Success|User deleted successfully!');
        return redirect()->route('admin.users.index');
    }

}
