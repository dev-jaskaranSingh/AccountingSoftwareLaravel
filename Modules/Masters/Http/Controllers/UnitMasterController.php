<?php

namespace Modules\Masters\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Modules\Masters\DataTables\UnitMasterDataTable;
use Modules\Masters\Entities\UnitMaster;
use Modules\Masters\Http\Requests\UnitMasterSaveRequest;
use Modules\Masters\Http\Requests\UnitMasterUpdateRequest;
use Session;

class UnitMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return void
     */
    public function index(UnitMasterDataTable $dataTable)
    {
        return $dataTable->render('masters::units_master.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(): Renderable
    {
        return view('masters::units_master.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param UnitMasterSaveRequest $request
     * @return RedirectResponse
     */
    public function store(UnitMasterSaveRequest $request): RedirectResponse
    {
        if (UnitMaster::create($request->validated())) {
            Session::flash('success', 'Success|Unit Saved successfully');
        } else {
            Session::flash('error', 'Failed|Failed to save Unit');
        }
        return back();
    }

    /**
     * Show the specified resource.
     * @param UnitMaster $unit
     * @return Renderable
     */
    public function show(UnitMaster $unit): Renderable
    {
        return view('masters::units_master.view', ['model' => $unit]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param UnitMaster $unit
     * @return Renderable
     */
    public function edit(UnitMaster $unit): Renderable
    {
        return view('masters::units_master.edit', ['model' => $unit]);
    }

    /**
     * Update the specified resource in storage.
     * @param UnitMasterUpdateRequest $request
     * @param UnitMaster $unit
     * @return RedirectResponse
     */
    public function update(UnitMasterUpdateRequest $request, UnitMaster $unit): RedirectResponse
    {
        if ($unit->update($request->validated())) {
            Session::flash('success', 'Success|Unit updated successfully');
        } else {
            Session::flash('error', 'Error|Failed to update Unit');
        }
        return redirect()->route('master.units.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param UnitMaster $unit
     * @return RedirectResponse
     */
    public function destroy(UnitMaster $unit): RedirectResponse
    {
        if ($unit->delete()) {
            Session::flash('success', 'Success|Unit deleted successfully');
        } else {
            Session::flash('error', 'Error|Unit could not be deleted');
        }
        return back();
    }
}
