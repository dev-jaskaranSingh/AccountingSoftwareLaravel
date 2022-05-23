<?php

namespace Modules\Transactions\Http\Controllers;

use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Modules\Masters\Entities\ItemMaster;
use Modules\Transactions\DataTables\PurchaseDataTable;
use Modules\Transactions\Entities\Purchase;
use Modules\Transactions\Http\Requests\PurchaseSaveRequest;
use Modules\Transactions\Http\Requests\PurchaseUpdateRequest;
use Modules\Transactions\Services\FinanceLedgerServices;
use Modules\Transactions\Services\PurchaseServices;
use Session;
use Throwable;

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
        $items = array_values(ItemMaster::orderBy('name','asc')
            ->pluck('name', 'id')->map(function ($value, $key) {
            return ['id' => $key, 'label' => $value];
        })->toArray());

        return view('transactions::purchases.create', compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     * @param PurchaseSaveRequest $request
     * @return RedirectResponse
     * @throws Throwable
     */
    public function store(PurchaseSaveRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            //Manipulate bill products data
            $filteredPurchaseItemsJson = $this->filteredPurchaseItemsArray($request->bill_products)->toJson();

            //Save Purchase bill
            $purchaseModel = Purchase::create($request->validated() + ['bill_products_json' => $filteredPurchaseItemsJson,'remarks' => $request->remarks]);

            //Manipulate Purchase bill items
            $purchaseItems = $this->mapPurchaseItemData($request->bill_products, $request->bill_date, $request->account_id, $request->invoice_number);

            //Save Purchase bill items
            $savedPurchaseItems = $purchaseModel->purchaseItems()->createMany($purchaseItems);

            // Save Finance Ledger
            PurchaseServices::savePurchaseInFinanceLedger('purchase', $purchaseModel, $request);

            // Save Stock
            PurchaseServices::saveStockMaster($savedPurchaseItems, 'purchase', $purchaseModel->id, $request->bill_date, $request->account_id, $request->invoice_number);

            DB::commit();
            Session::flash("success", "Success|Purchase saved Successfully");

        } catch (Exception $exception) {
            DB::rollBack();
            Session::flash("error", "Error|Purchase save failed");
            dd($exception);
        }
        return back();
    }

    /**
     * @param $bill_products
     * @param $bill_date
     * @param $account_id
     * @return array
     */
    public function mapPurchaseItemData($bill_products, $bill_date, $account_id): array
    {
        return $this->filteredPurchaseItemsArray($bill_products)
            ->map(fn($item) => ['item_id' => $item[0], 'bill_date' => $bill_date, 'account_id' => $account_id, 'company_id' => authCompany()->id, 'unit_id' => $item[18], 'unit' => $item[17], 'hsn_id' => $item[19], 'hsn_code' => $item[1], 'gross_wt' => $item[4], 'ting_wt' => $item[5], 'net_wt' => $item[6], 'rate_gm' => $item[7], 'amount' => $item[8], 'discount_percentage' => $item[9], 'discount' => $item[10], 'net_amount' => $item[11], 'cgst' => $item[12], 'sgst' => $item[13], 'igst' => $item[14], 'gst_amount' => $item[15], 'total' => $item[16], 'created_at' => now(), 'updated_at' => null])
            ->toArray();
    }

    /**
     * @param $bill_products
     * @return Collection
     */
    public function filteredPurchaseItemsArray($bill_products): Collection
    {
        return collect(json_decode($bill_products))
            ->filter(fn($item) => $item[0] != null);
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
        return view('transactions::purchases.edit', ['model' => $purchase,'purchase_items' => $purchase->bill_products_json]);
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
     * @throws Throwable
     */
    public function destroy(Purchase $purchase): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $purchase->delete();
            $purchase->ledgerEntries()->delete();
            $purchase->purchaseItems()->delete();
            Session::flash("success", "Success|Purchase has been deleted successfully");
            DB::commit();
        } catch (Throwable $exception) {
            DB::rollBack();
            Session::flash("error", "Error|Purchase Delete failed");
            dd(['code' => $exception->getCode(), 'message' => $exception->getMessage()]);
        } finally {
            return back();
        }
    }

    public function printPurchase(Purchase $purchase)
    {
        return view('transactions::purchases.print', ['model' => $purchase]);
    }
}
