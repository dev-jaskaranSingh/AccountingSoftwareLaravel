<?php

namespace Modules\Transactions\Http\Controllers;

use DB;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Modules\Transactions\DataTables\ReceiptDataTable;
use Modules\Transactions\Entities\FinanceLedger;
use Modules\Transactions\Http\Requests\ReceiptSaveRequest;
use Modules\Transactions\Services\FinanceLedgerServices;
use Session;
use Throwable;

class ReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param ReceiptDataTable $dataTable
     * @return mixed
     */
    public function index(ReceiptDataTable $dataTable): mixed
    {
        return $dataTable->render('transactions::receipts.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(): Renderable
    {
        return view('transactions::receipts.create');
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
            FinanceLedgerServices::saveReceiptInFinanceLedger($request, 'Receipt');
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
     * @param $receipt
     * @return Renderable
     */
    public function show($receipt): Renderable
    {
        return view('transactions::receipts.view', ['model' => $receipt]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param FinanceLedger $receipt
     * @return Renderable
     */
    public function edit(FinanceLedger $receipt): Renderable
    {
        return view('transactions::receipts.edit', ['model' => $receipt]);
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
            FinanceLedgerServices::saveReceiptInFinanceLedger($request, 'Receipt');
            Session::flash("success", "Success|Receipts has been updated successfully");
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
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        FinanceLedger::where('first_transaction_no', $id)->delete();
        Session::flash("success", "Success|Payment Entry deleted successfully");
        return back();
    }
}
