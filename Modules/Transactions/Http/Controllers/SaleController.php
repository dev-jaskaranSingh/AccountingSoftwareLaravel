<?php

namespace Modules\Transactions\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Masters\Entities\ItemMaster;
use Modules\Transactions\DataTables\SalesDataTable;
use Modules\Transactions\Entities\Purchase;
use Modules\Transactions\Entities\PurchaseItem;
use Modules\Transactions\Entities\Sale;
use Modules\Transactions\Entities\SaleItem;
use Modules\Transactions\Http\Requests\PurchaseSaveRequest;
use Modules\Transactions\Http\Requests\PurchaseUpdateRequest;
use Modules\Transactions\Http\Requests\SaleSaveRequest;
use Session;

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
        $items = array_values(ItemMaster::pluck('name', 'id')->map(function ($value, $key) {
            return ['id' => $key, 'label' => $value];
        })->toArray());

        return view('transactions::sales.create', compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     * @param SaleSaveRequest $request
     * @return RedirectResponse
     */
    public function store(SaleSaveRequest $request): RedirectResponse
    {
        $saleID = Sale::create($request->validated() + ['invoice_number' => Sale::getMaxInvoices() + 1])->id;
        if ($saleID) {
            $saleInvoiceItems = $this->mapPurchaseItemData($request, $saleID);
            if (SaleItem::insert($saleInvoiceItems)) {
                Session::flash("success", "Success|Purchase has been created successfully");
            } else {
                Session::flash('error', 'Something went wrong');
            }
        } else {
            Session::flash("error", "Error|Purchase save failed");
        }
        return back();
    }

    /**
     * @param $request
     * @param $sale_id
     * @return array
     */
    public function mapPurchaseItemData($request, $sale_id): array
    {
        return collect(json_decode($request->bill_products))->filter(function ($item) {
            return $item[0] != null;
        })->map(function ($item) use ($sale_id) {
            return ['sale_id' => $sale_id, 'item_id' => $item[0], 'hsn_code' => $item[1], 'gross_wt' => $item[4], 'ting_wt' => $item[5], 'net_wt' => $item[6], 'rate_gm' => $item[7], 'amount' => $item[8], 'discount_percentage' => $item[9], 'discount' => $item[10], 'net_amount' => $item[11], 'cgst' => $item[12], 'sgst' => $item[13], 'igst' => $item[14], 'gst_amount' => $item[15], 'total' => $item[16], 'unit' => $item[17], 'unit_id' => $item[18], 'hsn_id' => $item[19], 'created_at' => now(), 'updated_at' => null];
        })->toArray();
    }

    /**
     * Show the specified resource.
     * @param Sale $sales
     * @return Renderable
     */
    public function show(Sale $sales): Renderable
    {
        return view('transactions::sales.show', ['model' => $sales]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param Sale $sales
     * @return Renderable
     */
    public function edit(Sale $sales): Renderable
    {
        return view('transactions::sales.edit', ['model' => $sales]);
    }

    /**
     * Update the specified resource in storage.
     * @param PurchaseUpdateRequest $request
     * @param Sale $sales
     * @return RedirectResponse
     */
    public function update(PurchaseUpdateRequest $request, Sale $sales): RedirectResponse
    {
        $sales->update($request->validated());
        Session::flash("success", "Success|Purchase has been updated successfully");
        return back();
    }

    /**
     * Remove the specified resource from storage.
     * @param Sale $sales
     * @return RedirectResponse
     */
    public function destroy(Sale $sales): RedirectResponse
    {
        dump("Sales destroy");
        dd($sales);
        $sales->delete();
        Session::flash("success", "Success|Purchase has been deleted successfully");
        return back();
    }

    public function printPurchase(Sale $sales)
    {
        return view('transactions::sales.print', ['model' => $sales]);
    }
}
