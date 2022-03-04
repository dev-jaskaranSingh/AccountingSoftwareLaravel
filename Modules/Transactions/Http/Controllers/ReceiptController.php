<?php

namespace Modules\Transactions\Http\Controllers;

use DB;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use JetBrains\PhpStorm\NoReturn;
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
        return view('transactions::receipts.show', ['model' => $receipt]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param $receipt
     * @return Renderable
     */
    public function edit($receipt): Renderable
    {
        return view('transactions::receipts.edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int receipt
     * @return Renderable
     */
    #[NoReturn] public function update(Request $request, $receipt): Renderable
    {
        dd($request->all(), $receipt);
    }

    /**
     * Remove the specified resource from storage.
     * @param $receipt
     * @return void
     */
    public function destroy($id)
    {
        FinanceLedger::where('first_transaction_no', $id)->delete();
        Session::flash("success", "Success|Payment Entry deleted successfully");
        return back();
    }
}
