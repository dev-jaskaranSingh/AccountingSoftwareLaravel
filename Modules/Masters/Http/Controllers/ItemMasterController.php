<?php

namespace Modules\Masters\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Modules\Masters\DataTables\ItemMasterDataTable;
use Modules\Masters\Entities\ItemMaster;
use Modules\Masters\Http\Requests\ItemMasterSaveRequest;
use Modules\Masters\Http\Requests\ItemMasterUpdateRequest;
use Session;

class ItemMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return void
     */
    public function index(ItemMasterDataTable $dataTable)
    {
        return $dataTable->render('masters::items_master.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(): Renderable
    {
        return view('masters::items_master.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param ItemMasterSaveRequest $request
     * @return RedirectResponse
     */
    public function store(ItemMasterSaveRequest $request): RedirectResponse
    {
        ItemMaster::create($request->validated());
        Session::flash('success', 'Success|Item Master Created Successfully');
        return redirect()->route('master.items.index');
    }

    /**
     * Show the specified resource.
     * @param ItemMaster $item
     * @return Renderable
     */
    public function show(ItemMaster $item): Renderable
    {
        return view('masters::items_master.view', ['model' => $item]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param ItemMaster $item
     * @return Renderable
     */
    public function edit(ItemMaster $item): Renderable
    {
        return view('masters::items_master.edit', ['model' => $item]);
    }

    /**
     * Update the specified resource in storage.
     * @param ItemMasterUpdateRequest $request
     * @param ItemMaster $item
     * @return RedirectResponse
     */
    public function update(ItemMasterUpdateRequest $request, ItemMaster $item): RedirectResponse
    {
        $item->update($request->validated());
        Session::flash('success', 'Success|Item Master Updated Successfully');
        return redirect()->route('master.items.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param ItemMaster $item
     * @return RedirectResponse
     */
    public function destroy(ItemMaster $item): RedirectResponse
    {
        $item->delete();
        Session::flash('success', 'Success|Item deleted successfully');
        return redirect()->route('master.items.index');
    }
}
