<?php

namespace Modules\Transactions\Http\Controllers;

use DB;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Modules\Transactions\DataTables\ContraDataTable;
use Modules\Transactions\Entities\FinanceLedger;
use Modules\Transactions\Http\Requests\ReceiptSaveRequest;
use Modules\Transactions\Services\FinanceLedgerServices;
use Session;
use Throwable;

class ContraController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param ContraDataTable $dataTable
     * @return mixed
     */
    public function index(ContraDataTable $dataTable): mixed
    {
        return $dataTable->render('transactions::contra.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(): Renderable
    {
        return view('transactions::contra.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param ReceiptSaveRequest $request
     * @return RedirectResponse
     * @throws Throwable
     */
    public function store(ReceiptSaveRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            FinanceLedgerServices::saveReceiptInFinanceLedger($request, 'Contra');
            DB::commit();
            Session::flash("success", "Success|Receipt has been updated successfully");
        } catch (Throwable $e) {
            DB::rollBack();
            dd(['error' => $e->getMessage()]);
        } finally {
            return back();
        }
    }

    /**
     * Show the specified resource.
     * @param $contra
     * @return Renderable
     */
    public function show($contra): Renderable
    {
        return view('transactions::contra.show', ['model' => $contra]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param FinanceLedger $contra
     * @return Renderable
     */
    public function edit(FinanceLedger $contra): Renderable
    {
        return view('transactions::contra.edit', ['model' => $contra]);
    }

    /**
     * Update the specified resource in storage.
     * @param ReceiptSaveRequest $request
     * @param $firstTransactionNo
     * @return RedirectResponse
     * @throws Throwable
     */
    public function update(ReceiptSaveRequest $request, $firstTransactionNo): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $this->destroy($firstTransactionNo);
            FinanceLedgerServices::saveReceiptInFinanceLedger($request, 'Contra');
            Session::flash("success", "Success|Contra has been updated successfully");
        } catch (Throwable $e) {
            DB::rollBack();
            dd(['error' => $e->getMessage()]);
        } finally {
            DB::commit();
            return redirect()->route('transactions.receipts.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param $firstTransactionNumber
     * @return RedirectResponse
     */
    public function destroy($firstTransactionNumber): RedirectResponse
    {
        FinanceLedger::where('first_transaction_no', $firstTransactionNumber)->delete();
        Session::flash("success", "Success|Payment Entry deleted successfully");
        return back();
    }
}
