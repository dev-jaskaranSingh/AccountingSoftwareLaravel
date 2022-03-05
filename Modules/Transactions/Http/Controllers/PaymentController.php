<?php

namespace Modules\Transactions\Http\Controllers;

use DB;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Transactions\DataTables\PaymentDataTable;
use Modules\Transactions\Entities\FinanceLedger;
use Modules\Transactions\Http\Requests\ReceiptSaveRequest;
use Modules\Transactions\Services\FinanceLedgerServices;
use Session;
use Throwable;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param PaymentDataTable $dataTable
     * @return mixed
     */
    public function index(PaymentDataTable $dataTable): mixed
    {
        return $dataTable->render('transactions::payments.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('transactions::payments.create');
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
            FinanceLedgerServices::savePaymentInFinanceLedger($request, 'Payment');
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
     * @param int $id
     * @return Renderable
     */
    public function show(FinanceLedger $payment)
    {
        return view('transactions::payments.view',['model' => $payment]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(FinanceLedger $payment)
    {
        return view('transactions::payments.edit',['model' => $payment]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(ReceiptSaveRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param $id
     * @return Renderable
     */
    public function destroy($id): Renderable
    {
        FinanceLedger::where('first_transaction_no',$id)->delete();
        Session::flash("success", "Success|Payment Entry deleted successfully");
        return back();
    }
}
