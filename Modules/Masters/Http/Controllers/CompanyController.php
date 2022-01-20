<?php

namespace Modules\Masters\Http\Controllers;

use App\Models\Company;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Masters\DataTables\CompanyDataTable;
use Session;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return void
     */
    public function index(CompanyDataTable $dataTable)
    {
        return $dataTable->render('masters::company.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(): Renderable
    {
        return view('masters::company.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        Company::create($request->validate([
            'name' => 'required|unique:companies,name',
            'address' => '',
            'email' => 'email|unique:companies,email',
            'db_name' => 'unique:companies',
            'website' => '',
            'mobile' => '',
            'phone' => '',
            'to_date' => 'required|date',
            'from_date' => 'required|date',
            'pan' => '',
            'gstin' => 'required|unique:companies,gstin',
            'country_id' => 'required|exists:countries,id',
            'state_id' => 'required|exists:states,id',
            'city_id' => 'required|exists:cities,id',
            'pincode' => '',
            'gst_state_code' => ''
        ]));
        Session::flash('success', 'Success|Company Created Successfully');
        return back();
    }

    /**
     * Show the specified resource.
     * @param Company $company
     * @return Renderable
     */
    public function show(Company $company): Renderable
    {
        return view('masters::company.view', ['model' => $company]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param Company $company
     * @return Renderable
     */
    public function edit(Company $company): Renderable
    {
        return view('masters::company.edit', ['model' => $company]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Company $company
     * @return RedirectResponse
     */
    public function update(Request $request, Company $company): RedirectResponse
    {
        $company->update($request->validate([
            'name' => 'required|string|max:255',
            'email' => 'email',
            'db_name' => 'required|string|max:255',
            'website' => '',
            'mobile' => '',
            'phone' => '',
            'to_date' => 'required|date',
            'from_date' => 'required|date',
            'pan' => '',
            'gstin' => 'required',
            'country_id' => 'required|exists:countries,id',
            'state_id' => 'required|exists:states,id',
            'city_id' => 'required|exists:cities,id',
            'pincode' => '',
            'gst_state_code' => ''
        ]));
        Session::flash('success', 'Success|Company updated successfully');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     * @param Company $company
     * @return RedirectResponse
     */
    public function destroy(Company $company): RedirectResponse
    {
        $company->delete();
        Session::flash('success', 'Success|Company deleted successfully');
        return back();
    }
}
