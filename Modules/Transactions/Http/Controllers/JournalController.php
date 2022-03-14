<?php

namespace Modules\Transactions\Http\Controllers;

use DB;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Transactions\DataTables\JournalDataTable;
use Modules\Transactions\Entities\FinanceLedger;
use Modules\Transactions\Services\FinanceLedgerServices;
use Session;
use Throwable;

class JournalController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param JournalDataTable $dataTable
     * @return mixed
     */
    public function index(JournalDataTable $dataTable): mixed
    {
        return $dataTable->render('transactions::journal.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('transactions::journal.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     * @throws Throwable
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $journalFormValues = json_decode($request->journalFormValues, true);
            FinanceLedgerServices::saveJournalInFinanceLedger($journalFormValues, 'Journal');
            DB::commit();
            Session::flash("success", "Success|Journal has been updated successfully");
        } catch (Throwable $e) {
            DB::rollBack();
            dd(['error' => $e->getMessage()]);
        } finally {
            return back();
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('transactions::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('transactions::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        FinanceLedger::where('first_transaction_no', $id)->delete();
        Session::flash("success", "Success|Journal Entry deleted successfully");
        return back();
    }
}
