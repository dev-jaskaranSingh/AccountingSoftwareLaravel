<?php

namespace Modules\Masters\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
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
        dd($request->all());
    }

    /**
     * Show the specified resource.
     * @param AccountMaster $master
     * @return Renderable
     */
    public function show(AccountMaster $master): Renderable
    {
        return view('masters::account_master.show', ['model' => $master]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param AccountMaster $master
     * @return Renderable
     */
    public function edit(AccountMaster $master): Renderable
    {
        return view('masters::account_master.edit', ['model' => $master]);
    }

    /**
     * Update the specified resource in storage.
     * @param AccountMasterUpdateRequest $request
     * @param AccountMaster $master
     * @return Renderable
     */
    public function update(AccountMasterUpdateRequest $request, AccountMaster $master): Renderable
    {
        dd($request->all(), $master);
    }

    /**
     * Remove the specified resource from storage.
     * @param AccountMaster $master
     * @return Renderable
     */
    public function destroy(AccountMaster $master): Renderable
    {
        dd($master);
    }
}
