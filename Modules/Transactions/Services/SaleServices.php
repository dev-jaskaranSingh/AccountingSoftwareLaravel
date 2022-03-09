<?php

namespace Modules\Transactions\Services;

use Modules\Masters\Entities\AccountMaster;
use Modules\Transactions\Entities\FinanceLedger;
use Modules\Transactions\Repositories\StockMasterRepository;

class SaleServices
{
    /**
     * @param $type
     * @param $saleModel
     * @param $request
     * @return mixed
     */
    public static function saveSaleInFinanceLedger($type, $saleModel, $request): mixed
    {

        $SALE_ID = 30;
        $CGST_INPUT_ID = 20;
        $SGST_INPUT_ID = 21;
        $IGST_INPUT_ID = 22;
        $ROUND_OFF = 23;
        $TCS_INPUT = 2;
        $insertArray = [];

        $accountMasterModel = AccountMaster::with('accountGroup')
            ->whereNull('created_at')
            ->whereIn('id', [$CGST_INPUT_ID, $SGST_INPUT_ID, $IGST_INPUT_ID, $ROUND_OFF, $SALE_ID, $TCS_INPUT])
            ->get();

        $partySaleInsertArray = [
            'bill_id' => $saleModel->id,
            'bill_number' => $saleModel->invoice_number,
            'bill_date' => $saleModel->bill_date,
            'debit' => $saleModel->grand_total_amount,
            'credit' => 0,
            'narration' => '',
            'bill_type' => $type,
            'account_id' => $saleModel->account_id,
            'account_id2' => $SALE_ID,
            'account_name' => $saleModel->account->name,
            'first_transaction_no' => 0,
            'created_by' => authUser()->id,
        ];

        $saleDebitInsertModel = FinanceLedger::create($partySaleInsertArray);

        $purchaseAccountModel = $accountMasterModel->find($SALE_ID);

        $insertArray[] = [
            'bill_id' => $saleModel->id,
            'bill_number' => $saleModel->invoice_number,
            'bill_date' => $saleModel->bill_date,
            'debit' => 0,
            'credit' => $saleModel->total_net_amount,
            'narration' => '',
            'bill_type' => $type,
            'account_id' => $SALE_ID,
            'account_id2' => $saleModel->account_id,
            'account_name' => $purchaseAccountModel->name,
            'first_transaction_no' => $saleDebitInsertModel->id,
            'created_by' => authUser()->id,
            'created_at' => now(),
            'updated_at' => null
        ];

        if ($saleModel->igst > 0) {
            $IgstAccountModel = $accountMasterModel->find($IGST_INPUT_ID);
            $insertArray[] = [
                'bill_id' => $saleModel->id,
                'bill_number' => $saleModel->invoice_number,
                'bill_date' => $saleModel->bill_date,
                'debit' => 0,
                'credit' => $saleModel->igst,
                'narration' => '',
                'bill_type' => $type,
                'account_id' => $IGST_INPUT_ID,
                'account_id2' => $saleModel->account_id,
                'account_name' => $IgstAccountModel->name,
                'first_transaction_no' => $saleDebitInsertModel->id,
                'created_by' => authUser()->id,
                'created_at' => now(),
                'updated_at' => null
            ];

        } else if ($saleModel->cgst > 0) {
            $accountCGSTModel = $accountMasterModel->find($CGST_INPUT_ID);
            $accountSGSTModel = $accountMasterModel->find($SGST_INPUT_ID);
            $insertArray[] = ['bill_id' => $saleModel->id,
                'bill_number' => $saleModel->invoice_number,
                'bill_date' => $saleModel->bill_date,
                'debit' => 0,
                'credit' => $saleModel->cgst,
                'narration' => '',
                'bill_type' => $type,
                'account_id' => $accountCGSTModel->id,
                'account_id2' => $saleModel->account_id,
                'account_name' => $accountCGSTModel->name,
                'first_transaction_no' => $saleDebitInsertModel->id,
                'created_by' => authUser()->id,
                'created_at' => now(),
                'updated_at' => null
            ];
            $insertArray[] = [
                'bill_id' => $saleModel->id,
                'bill_number' => $saleModel->invoice_number,
                'bill_date' => $saleModel->bill_date,
                'debit' => 0,
                'credit' => $saleModel->sgst,
                'narration' => '',
                'bill_type' => $type,
                'account_id' => $accountSGSTModel->id,
                'account_id2' => '',
                'account_name' => $accountSGSTModel->name,
                'first_transaction_no' => $saleDebitInsertModel->id,
                'created_by' => authUser()->id,
                'created_at' => now(),
                'updated_at' => null
            ];
        }

        if (!is_null($saleModel->round_off_value)) {
            $accountROUNDOFFModel = $accountMasterModel->find($ROUND_OFF);
            $insertArray[] = [
                'bill_id' => $saleModel->id,
                'bill_number' => $saleModel->invoice_number,
                'bill_date' => $saleModel->bill_date,
                'debit' => $saleModel->round_off_value,
                'credit' => 0,
                'narration' => '',
                'bill_type' => $type,
                'account_id' => $ROUND_OFF,
                'account_id2' => $saleModel->account_id,
                'account_name' => $accountROUNDOFFModel->name,
                'first_transaction_no' => $saleDebitInsertModel->id,
                'created_by' => authUser()->id,
                'created_at' => now(),
                'updated_at' => null
            ];
        }

        if (!is_null($saleModel->tcs)) {
            $TcsModel = $accountMasterModel->find($TCS_INPUT);
            $insertArray[] = [
                'bill_id' => $saleModel->id,
                'bill_number' => $saleModel->invoice_number,
                'bill_date' => $saleModel->bill_date,
                'debit' => 0,
                'credit' => $saleModel->tcs,
                'narration' => '',
                'bill_type' => $type,
                'account_id' => $TCS_INPUT,
                'account_id2' => $saleModel->account_id,
                'account_name' => $TcsModel->name,
                'first_transaction_no' => $saleDebitInsertModel->id,
                'created_by' => authUser()->id,
                'created_at' => now(),
                'updated_at' => null
            ];
        }
        $saleDebitInsertModel->update(['first_transaction_no' => $saleDebitInsertModel->id]);
        return FinanceLedger::insert($insertArray);
    }


    public static function saveSaleStockMaster($saleItems, $voucher_type, $sale_id, $bill_date, $account_id, $invoice_number)
    {

        $insertData = $saleItems->map(fn($item) => [
            'account_id' => $account_id,
            'item_id' => $item['item_id'],
            'invoice_id' => $item['sale_id'],
            'invoice_number' => $invoice_number,
            'bill_date' => $bill_date,
            'unit_id' => $item['unit_id'],
            'unit_name' => $item['unit'],
            'hsn_id' => $item['hsn_id'],
            'hsn_code' => $item['hsn_code'],
            'gross_wt' => $item['gross_wt'],
            'ting_wt' => $item['ting_wt'],
            'net_wt' => $item['net_wt'],
            'rate_gm' => $item['rate_gm'],
            'discount' => $item['discount'],
            'net_amount' => $item['net_amount'],
            'cgst' => $item['cgst'],
            'sgst' => $item['sgst'],
            'igst' => $item['igst'],
            'gst_amount' => $item['gst_amount'],
            'total' => $item['total'],
            'voucher_type' => $voucher_type,
            'created_at' => now(),
            'updated_at' => null
        ]);
        return StockMasterRepository::save($insertData);
    }
}
