<?php

namespace Modules\Transactions\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Modules\Masters\Entities\ItemMaster;
use Modules\Transactions\DataTables\PurchaseDataTable;
use Modules\Transactions\Entities\Purchase;
use Modules\Transactions\Entities\PurchaseItem;
use Modules\Transactions\Http\Requests\PurchaseSaveRequest;
use Modules\Transactions\Http\Requests\PurchaseUpdateRequest;
use Session;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param PurchaseDataTable $dataTable
     * @return void
     */
    public function index(PurchaseDataTable $dataTable)
    {
        return $dataTable->render('transactions::purchases.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(): Renderable
    {
        $items = array_values(ItemMaster::pluck('name', 'id')->map(function ($value, $key) {
            return ['id' => $key, 'label' => $value];
        })->toArray());

        return view('transactions::purchases.create', compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     * @param PurchaseSaveRequest $request
     * @return RedirectResponse
     */
    public function store(PurchaseSaveRequest $request): RedirectResponse
    {   

        $purchase_id = Purchase::create($request->validated() + ['invoice_number' => Purchase::getMaxInvoices() + 1])->id;
        if ($purchase_id) {
            $data = collect(json_decode($request->bill_products))->filter(function ($item) {
                return $item[0] != null;
            })->map(function ($item) use ($purchase_id) {
                return [
                    'purchase_id' => $purchase_id,
                    'item_id' => $item[0],
                    'hsn_code' => $item[1],
                    'gross_wt' => $item[2],
                    'net_wt' => $item[3],
                    'rate_gm' => $item[4],
                    'amount' => $item[5],
                    'unit' => $item[6],
                    'unit_id' => $item[7],
                    'hsn_id' => $item[8],
                    'created_at' => now(),
                    'updated_at' => null,
                ];
            })->toArray();
            if (PurchaseItem::insert($data)) {
                Session::flash("success", "Success|Purchase has been created successfully");
            } else {
                Session::flash('error', 'Something went wrong');
            }
        }else{
            Session::flash("error", "Error|Purchase save failed");
        }

        return back();
    }

    /**
     * Show the specified resource.
     * @param Purchase $purchase
     * @return Renderable
     */
    public function show(Purchase $purchase): Renderable
    {
        return view('transactions::purchases.show', ['model' => $purchase]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param Purchase $purchase
     * @return Renderable
     */
    public function edit(Purchase $purchase): Renderable
    {
        return view('transactions::purchases.edit', ['model' => $purchase]);
    }

    /**
     * Update the specified resource in storage.
     * @param PurchaseUpdateRequest $request
     * @param Purchase $purchase
     * @return RedirectResponse
     */
    public function update(PurchaseUpdateRequest $request, Purchase $purchase): RedirectResponse
    {
        $purchase->update($request->validated());
        Session::flash("success", "Success|Purchase has been updated successfully");
        return back();
    }

    /**
     * Remove the specified resource from storage.
     * @param Purchase $purchase
     * @return RedirectResponse
     */
    public function destroy(Purchase $purchase): RedirectResponse
    {
        $purchase->delete();
        Session::flash("success", "Success|Purchase has been deleted successfully");
        return back();
    }

    public  function printPurchase(Purchase $purchase){
        return view('transactions::purchases.print', ['model' => $purchase]);
    }
}
