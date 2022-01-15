<?php

namespace Modules\Masters\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\Masters\DataTables\AccountMasterDataTable;
use Modules\Masters\Entities\AccountMaster;
use Modules\Masters\Http\Requests\AccountMasterSaveRequest;
use Modules\Masters\Http\Requests\AccountMasterUpdateRequest;

class AccountMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return void
     */
    public function index(AccountMasterDataTable $dataTable)
    {
        return $dataTable->render('masters::account_master.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(): Renderable
    {
        return view('masters::account_master.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param AccountMasterSaveRequest $request
     * @return RedirectResponse
     */
    public function store(AccountMasterSaveRequest $request): RedirectResponse
    {
        AccountMaster::create($request->validated());
        Session::flash('success', 'Success|Account Created Successfully');
        return redirect()->route('master.accounts.index');
    }

    /**
     * Show the specified resource.
     * @param AccountMaster $account
     * @return Renderable
     */
    public function show(AccountMaster $account): Renderable
    {
        return view('masters::account_master.view', ['model' => $account]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param AccountMaster $account
     * @return Renderable
     */
    public function edit(AccountMaster $account): Renderable
    {
        return view('masters::account_master.edit', ['model' => $account]);
    }

    /**
     * Update the specified resource in storage.
     * @param AccountMasterUpdateRequest $request
     * @param AccountMaster $account
     * @return RedirectResponse
     */
    public function update(AccountMasterUpdateRequest $request, AccountMaster $account): RedirectResponse
    {
        $account->update($request->validated());
        Session::flash('success', 'Success|Account Updated Successfully');
        return redirect()->route('master.accounts.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param AccountMaster $account
     * @return RedirectResponse
     */
    public function destroy(AccountMaster $account): RedirectResponse
    {
        $account->delete();
        Session::flash('success', 'Success|Account Deleted Successfully');
        return back();
    }
}
