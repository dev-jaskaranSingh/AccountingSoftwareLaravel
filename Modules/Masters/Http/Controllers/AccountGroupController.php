<?php

namespace Modules\Masters\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Modules\Masters\DataTables\AccountGroupDataTable;
use Modules\Masters\Entities\AccountGroup;
use Modules\Masters\Http\Requests\AccountGroupSaveRequest;
use Session;

class AccountGroupController extends Controller
{

    public function index(AccountGroupDataTable $dataTable)
    {
        return $dataTable->render('masters::account_group.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(): Renderable
    {
        return view('masters::account_group.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param AccountGroupSaveRequest $request
     * @return RedirectResponse
     */
    public function store(AccountGroupSaveRequest $request): RedirectResponse
    {
        AccountGroup::create($request->validated());
        Session::flash('success', 'Success|Account Group Created Successfully');
        return redirect()->route('group.index');
    }

    /**
     * Show the specified resource.
     * @param AccountGroup $accountGroup
     * @return Renderable
     */
    public function show(AccountGroup $accountGroup): Renderable
    {
        return view('masters::account_group.show', ['model' => $accountGroup]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param AccountGroup $accountGroup
     * @return Renderable
     */
    public function edit(AccountGroup $accountGroup): Renderable
    {
        return view('masters::account_group.edit', ['model' => $accountGroup]);
    }

    /**
     * Update the specified resource in storage.
     * @param AccountGroupSaveRequest $request
     * @param AccountGroup $accountGroup
     * @return Renderable
     */
    public function update(AccountGroupSaveRequest $request, AccountGroup $accountGroup): Renderable
    {

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(AccountGroup $accountGroup)
    {
        //
    }
}
