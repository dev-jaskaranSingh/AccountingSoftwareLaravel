<?php

namespace Modules\Masters\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\Masters\DataTables\HsnMasterDataTable;
use Modules\Masters\Entities\HsnMaster;
use Modules\Masters\Http\Requests\HsnMasterSaveRequest;
use Modules\Masters\Http\Requests\HsnMasterUpdateRequest;

class HSNMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return void
     */
    public function index(HsnMasterDataTable $dataTable)
    {
        return $dataTable->render('masters::hsn_master.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(): Renderable
    {
        return view('masters::hsn_master.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param HsnMasterSaveRequest $request
     * @return RedirectResponse
     */
    public function store(HsnMasterSaveRequest $request): RedirectResponse
    {
        if (HsnMaster::create($request->validated())) {
            Session::flash('success', 'Success|HSN Code Created Successfully');
        } else {
            Session::flash('error', 'Error|HSN Code Creation Failed');
        }
        return redirect()->route('master.hsn.index');
    }

    /**
     * Show the specified resource.
     * @param HsnMaster $hsn
     * @return Renderable
     */
    public function show(HsnMaster $hsn): Renderable
    {
        return view('masters::hsn_master.view',['model'=>$hsn]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param HsnMaster $hsn
     * @return Renderable
     */
    public function edit(HsnMaster $hsn): Renderable
    {
        return view('masters::hsn_master.edit', ['model' => $hsn]);
    }

    /**
     * Update the specified resource in storage.
     * @param HsnMasterUpdateRequest $request
     * @param HsnMaster $hsn
     * @return RedirectResponse
     */
    public function update(HsnMasterUpdateRequest $request, HsnMaster $hsn): RedirectResponse
    {
        if ($hsn->update($request->validated())) {
            Session::flash('success', 'Success|HSN Code Updated Successfully');
        } else {
            Session::flash('error', 'Error|HSN Code Updating Failed');
        }
        return redirect()->route('master.hsn.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param HsnMaster $hsn
     * @return RedirectResponse
     */
    public function destroy(HsnMaster $hsn): RedirectResponse
    {
        $hsn->delete();
        Session::flash('success', 'Success|HSN Code Deleted Successfully');
        return back();
    }
}
