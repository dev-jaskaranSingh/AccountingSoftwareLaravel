<?php

namespace Modules\Transactions\Http\Controllers;

use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Modules\Masters\Entities\ItemMaster;
use Modules\Transactions\DataTables\SalesDataTable;
use Modules\Transactions\Entities\Sale;
use Modules\Transactions\Entities\StockMaster;
use Modules\Transactions\Http\Requests\SaleSaveRequest;
use Modules\Transactions\Http\Requests\SaleUpdateRequest;
use Modules\Transactions\Services\SaleServices;
use Session;
use Throwable;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(SalesDataTable $dataTable)
    {
        return $dataTable->render('transactions::sales.index');
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

        return view('transactions::sales.create', compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     * @param SaleSaveRequest $request
     * @return RedirectResponse
     * @throws Throwable
     */
    public function store(SaleSaveRequest $request): RedirectResponse
    {
        try {

            DB::beginTransaction();

            //Manipulate bill products data
            $filteredSaleItemsJson = $this->filteredSaleItemsArray($request->bill_products)->toJson();

            //Save Sale bill
            $saleModel = Sale::create($request->validated() + ['bill_products_json' => $filteredSaleItemsJson, 'invoice_number' => getSalesMaxInvoices() + 1]);

            //Manipulate Sale bill items
            $saleItems = $this->mapSaleItemData($request->bill_products, $request->bill_date, $request->account_id, $request->invoice_number);

            //Save Sale bill items
            $savedSaleItems = $saleModel->saleItems()->createMany($saleItems);

            // Save Finance Ledger
            SaleServices::saveSaleInFinanceLedger('sale', $saleModel, $request);

            // Save Stock
            SaleServices::saveSaleStockMaster($savedSaleItems, 'sale', $saleModel->id, $request->bill_date, $request->account_id, $request->invoice_number);

            DB::commit();
            Session::flash("success", "Success|Sale saved Successfully");

        } catch (Exception $exception) {
            DB::rollBack();
            Session::flash("error", "Error|Sale save failed");
            dd($exception);
        }
        return back();
    }

    /**
     * @param $bill_products
     * @return Collection
     */
    public function filteredSaleItemsArray($bill_products): Collection
    {
        return collect(json_decode($bill_products))
            ->filter(fn($item) => $item[0] != null);
    }

    /**
     * @param $bill_products
     * @param $bill_date
     * @param $account_id
     * @return array
     */
    public function mapSaleItemData($bill_products, $bill_date, $account_id): array
    {
        return $this->filteredSaleItemsArray($bill_products)
            ->map(fn($item) => ['item_id' => $item[0], 'bill_date' => $bill_date, 'account_id' => $account_id, 'company_id' => authCompany()->id, 'unit_id' => $item[18], 'unit' => $item[17], 'hsn_id' => $item[19], 'hsn_code' => $item[1], 'gross_wt' => $item[4], 'ting_wt' => $item[5], 'net_wt' => $item[6], 'rate_gm' => $item[7], 'amount' => $item[8], 'discount_percentage' => $item[9], 'discount' => $item[10], 'net_amount' => $item[11], 'cgst' => $item[12], 'sgst' => $item[13], 'igst' => $item[14], 'gst_amount' => $item[15], 'total' => $item[16], 'created_at' => now(), 'updated_at' => null])
            ->toArray();
    }

    /**
     * Show the specified resource.
     * @param StockMaster $sale
     * @return Renderable
     */
    public function show(Sale $sale): Renderable
    {
        return view('transactions::sales.show', ['model' => $sale]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param StockMaster $sale
     * @return Renderable
     */
    public function edit(Sale $sale): Renderable
    {
        return view('transactions::sales.edit', ['model' => $sale]);
    }

    /**
     * Update the specified resource in storage.
     * @param SaleUpdateRequest $request
     * @param StockMaster $sale
     * @return RedirectResponse
     */
    public function update(SaleUpdateRequest $request, StockMaster $sale): RedirectResponse
    {
        $sale->update($request->validated());
        Session::flash("success", "Success|Sale has been updated successfully");
        return back();
    }

    /**
     * Remove the specified resource from storage.
     * @param Sale $sale
     * @return RedirectResponse
     * @throws Throwable
     */
    public function destroy(Sale $sale): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $sale->delete();
            $sale->ledgerEntries()->delete();
            $sale->saleItems()->delete();
            Session::flash("success", "Success|Sale has been deleted successfully");
            DB::commit();
        } catch (Throwable $exception) {
            DB::rollBack();
            Session::flash("error", "Error|Sale Delete failed");
            dd(['code' => $exception->getCode(), 'message' => $exception->getMessage()]);
        } finally {
            return back();
        }
    }

    public function printSaleInvoice(Sale $sales)
    {
        return view('transactions::sales.sale-print', ['model' => $sales]);
    }
}
