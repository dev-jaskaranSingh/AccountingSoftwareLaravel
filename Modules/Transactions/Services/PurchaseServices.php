<?php

namespace Modules\Transactions\Services;

use Modules\Transactions\Repositories\StockMasterRepository;

class PurchaseServices
{

    public static function saveStockMaster($purchaseItems, $voucher_type, $purchase_id,$bill_date,$account_id, $invoice_number){

        $insertData = collect($purchaseItems)->map(function($item) use ($purchase_id, $voucher_type, $bill_date, $account_id, $invoice_number){
            return [
                'account_id'     =>  $account_id,
                'item_id'        =>  $item['item_id'],
                'invoice_id'     =>  $item['purchase_id'],
                'invoice_number' =>  $invoice_number,
                'bill_date'      =>  $bill_date,
                'unit_id'        =>  $item['unit_id'],
                'unit_name'      =>  $item['unit'],
                'hsn_id'         =>  $item['hsn_id'],
                'hsn_code'       =>  $item['hsn_code'],
                'gross_wt'       =>  $item['gross_wt'],
                'ting_wt'        =>  $item['ting_wt']   ,
                'net_wt'         =>  $item['net_wt'],
                'rate_gm'        =>  $item['rate_gm'],
                'discount'       =>  $item['discount'],
                'net_amount'     =>  $item['net_amount'],
                'cgst'           =>  $item['cgst'],
                'sgst'           =>  $item['sgst'],
                'igst'           =>  $item['igst'],
                'gst_amount'     =>  $item['gst_amount'],
                'total'          =>  $item['total'],
                'voucher_type'   =>  $voucher_type,
                'created_at'     =>  now(),
                'updated_at'     =>  null
            ];
        });
         return StockMasterRepository::save($insertData);
    }
}
