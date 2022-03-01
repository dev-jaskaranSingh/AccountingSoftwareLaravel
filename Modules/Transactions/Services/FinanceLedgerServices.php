<?php

namespace Modules\Transactions\Services;

use Modules\Masters\Entities\AccountMaster;
use Modules\Transactions\Entities\FinanceLedger;

class FinanceLedgerServices
{

    public static function savePurchaseInFinanceLedger($type, $purchaseModel, $request)
    {
        $PURCHASE_ID = 19;
        $CGST_INPUT_ID = 20;
        $SGST_INPUT_ID = 21;
        $IGST_INPUT_ID = 22;
        $ROUND_OFF = 23;
        $TCS_INPUT = 2;
        $insertArray = [];

        $accountMasterModel = AccountMaster::with('accountGroup')
            ->whereNull('created_at')
            ->whereIn('id', [$CGST_INPUT_ID, $SGST_INPUT_ID, $IGST_INPUT_ID, $ROUND_OFF, $PURCHASE_ID, $TCS_INPUT])
            ->get();

        $partyPurchaseInsertArray = [
            'bill_id' => $purchaseModel->id,
            'bill_number' => $purchaseModel->invoice_number,
            'bill_date' => $purchaseModel->bill_date,
            'debit' => 0,
            'credit' => $purchaseModel->grand_total_amount,
            'narration' => '',
            'bill_type' => $type,
            'account_id' => $purchaseModel->account_id,
            'account_id2' => $PURCHASE_ID,
            'account_name' => $purchaseModel->account->name,
            'first_transaction_no' => 0,
            'created_by' => authUser()->id,
        ];

        $purchaseDebitInsertModel = FinanceLedger::create($partyPurchaseInsertArray);

        $purchaseAccountModel = $accountMasterModel->find($PURCHASE_ID);

        $insertArray[] = [
            'bill_id' => $purchaseModel->id,
            'bill_number' => $purchaseModel->invoice_number,
            'bill_date' => $purchaseModel->bill_date,
            'debit' => $purchaseModel->total_net_amount,
            'credit' => 0,
            'narration' => '',
            'bill_type' => $type,
            'account_id' => $PURCHASE_ID,
            'account_id2' =>  $purchaseModel->account_id,
            'account_name' => $purchaseAccountModel->name,
            'first_transaction_no' => $purchaseDebitInsertModel->id,
            'created_by' => authUser()->id,
            'created_at' => now(),
            'updated_at' => null
        ];



        if ($purchaseModel->igst > 0) {
            $IgstAcountModel = $accountMasterModel->find($IGST_INPUT_ID);
            $insertArray[] = [
                'bill_id' => $purchaseModel->id,
                'bill_number' => $purchaseModel->invoice_number,
                'bill_date' => $purchaseModel->bill_date,
                'debit' => $purchaseModel->igst,
                'credit' => 0,
                'narration' => '',
                'bill_type' => $type,
                'account_id' => $IGST_INPUT_ID,
                'account_id2' => $purchaseModel->account_id,
                'account_name' => $IgstAcountModel->name,
                'first_transaction_no' => $purchaseDebitInsertModel->id,
                'created_by' => authUser()->id,
                'created_at' => now(),
                'updated_at' => null
            ];

        } else if ($purchaseModel->cgst > 0) {
            $accountCGSTModel = $accountMasterModel->find($CGST_INPUT_ID);
            $accountSGSTModel = $accountMasterModel->find($SGST_INPUT_ID);
            $insertArray[] = ['bill_id' => $purchaseModel->id,
                'bill_number' => $purchaseModel->invoice_number,
                'bill_date' => $purchaseModel->bill_date,
                'debit' => $purchaseModel->cgst,
                'credit' => 0,
                'narration' => '',
                'bill_type' => $type,
                'account_id' => $accountCGSTModel->id,
                'account_id2' => $purchaseModel->account_id,
                'account_name' => $accountCGSTModel->name,
                'first_transaction_no' => $purchaseDebitInsertModel->id,
                'created_by' => authUser()->id,
                'created_at' => now(),
                'updated_at' => null
            ];
            $insertArray[] = [
                'bill_id' => $purchaseModel->id,
                'bill_number' => $purchaseModel->invoice_number,
                'bill_date' => $purchaseModel->bill_date,
                'debit' => $purchaseModel->sgst,
                'credit' => 0,
                'narration' => '',
                'bill_type' => $type,
                'account_id' => $accountSGSTModel->id,
                'account_id2' => '',
                'account_name' => $accountSGSTModel->name,
                'first_transaction_no' => $purchaseDebitInsertModel->id,
                'created_by' => authUser()->id,
                'created_at' => now(),
                'updated_at' => null
            ];
        }

        if (!is_null($purchaseModel->round_off_value)) {
            $accountROUNDOFFModel = $accountMasterModel->find($ROUND_OFF);
            $insertArray[] = [
                'bill_id' => $purchaseModel->id,
                'bill_number' => $purchaseModel->invoice_number,
                'bill_date' => $purchaseModel->bill_date,
                'debit' => 0,
                'credit' => $purchaseModel->round_off_value,
                'narration' => '',
                'bill_type' => $type,
                'account_id' => $ROUND_OFF,
                'account_id2' => $purchaseModel->account_id,
                'account_name' => $accountROUNDOFFModel->name,
                'first_transaction_no' => $purchaseDebitInsertModel->id,
                'created_by' => authUser()->id,
                'created_at' => now(),
                'updated_at' => null
            ];
        }

        if (!is_null($purchaseModel->tcs)) {
            $TcsModel = $accountMasterModel->find($TCS_INPUT);
            $insertArray[] = [
                'bill_id' => $purchaseModel->id,
                'bill_number' => $purchaseModel->invoice_number,
                'bill_date' => $purchaseModel->bill_date,
                'debit' => $purchaseModel->tcs,
                'credit' => 0,
                'narration' => '',
                'bill_type' => $type,
                'account_id' => $TCS_INPUT,
                'account_id2' => $purchaseModel->account_id,
                'account_name' => $TcsModel->name,
                'first_transaction_no' => $purchaseDebitInsertModel->id,
                'created_by' => authUser()->id,
                'created_at' => now(),
                'updated_at' => null
            ];
            $purchaseDebitInsertModel->update(['first_transaction_no' => $purchaseDebitInsertModel->id]);
            return FinanceLedger::insert($insertArray);
        }
    }
}
