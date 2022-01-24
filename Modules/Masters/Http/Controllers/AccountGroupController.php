<?php

namespace Modules\Masters\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Modules\Masters\DataTables\AccountGroupDataTable;
use Modules\Masters\DataTables\UnitMasterDataTable;
use Modules\Masters\Entities\AccountGroup;
use Modules\Masters\Entities\AccountSubGroup;
use Modules\Masters\Http\Requests\AccountGroupSaveRequest;
use Modules\Masters\Http\Requests\AccountGroupUpdateRequest;
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
        $accountGroup = AccountGroup::create($request->validated());
        if($request->is_primary !== 'on' && !is_null($request->sub_group_id)){
            AccountSubGroup::create([
                'parent_id' => $request->sub_group_id,
                'child_id' => $accountGroup->id,
            ]);
        }
        Session::flash('success', 'Success|Account Group Created Successfully');
        return back();
    }

    /**
     * Show the specified resource.
     * @param AccountGroup $account_group
     * @return Renderable
     */
    public function show(AccountGroup $account_group): Renderable
    {
        return view('masters::account_group.view', ['model' => $account_group->load('children', 'parent')]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param AccountGroup $account_group
     * @return Renderable
     */
    public function edit(AccountGroup $account_group): Renderable
    {
        if($account_group->is_default == 0) abort(403);
        return view('masters::account_group.edit', ['model' => $account_group]);
    }

    /**
     * Update the specified resource in storage.
     * @param AccountGroupUpdateRequest $request
     * @param AccountGroup $account_group
     * @return RedirectResponse
     */
    public function update(AccountGroupUpdateRequest $request, AccountGroup $account_group): RedirectResponse
    {
        AccountSubGroup::where('child_id', $account_group->id)->delete();
        if (!isset($request->is_primary)) {
            if (is_null($request->sub_group_id)) {
                Session::flash('error', 'Error|Please Select Sub Group');
                return back();
            }
            AccountSubGroup::create([
                'parent_id' => $request->sub_group_id,
                'child_id' => $account_group->id,
            ]);
            $account_group->update($request->validated() + ['is_primary' => 0]);
        } else {
            $account_group->update($request->validated());
        }Session::flash('success', 'Success|Account Group Updated Successfully');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     * @param AccountGroup $account_group
     * @return RedirectResponse
     */
    public function destroy(AccountGroup $account_group): RedirectResponse
    {
        $account_group->delete();
        Session::flash('success', 'Success|Account Group Deleted Successfully');
        return back();
    }
}
