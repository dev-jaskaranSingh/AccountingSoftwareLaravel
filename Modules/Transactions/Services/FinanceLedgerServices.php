<?php

namespace Modules\Transactions\Services;

use Modules\Masters\Entities\AccountMaster;
use Modules\Transactions\Entities\FinanceLedger;
use Modules\Transactions\Repositories\FinanceLedgerRepository;

class FinanceLedgerServices
{

    public static function saveFinanceLedger($type, $purchaseModel, $request)
    {
        $PURCHASE_ID = 19;
        $CGST_INPUT_ID = 20;
        $SGST_INPUT_ID = 21;
        $IGST_INPUT_ID = 22;
        $ROUND_OFF = 23;
        $TCS_INPUT = 2;

        $financeLedgerModel = FinanceLedger::orderBy('id', 'desc')->first();
        $lastInsertedId = is_null($financeLedgerModel) ? 1 : $financeLedgerModel->id;
        $accountMasterModel = AccountMaster::with('accountGroup')
            ->whereNull('created_at')
            ->whereIn('id', [$CGST_INPUT_ID, $SGST_INPUT_ID, $IGST_INPUT_ID, $ROUND_OFF, $PURCHASE_ID])
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
            'account_name' => $purchaseModel->account->name,
            'account_group_id' => $purchaseModel->account->account_group_id,
            'account_group_name' => $purchaseModel->account->accountGroup->name,
            'first_transaction_no' => $lastInsertedId,
            'created_by' => authUser()->id,
        ];

        $purchaseDebitInsertModel = FinanceLedger::create($partyPurchaseInsertArray);

        $purchaseInsertArray = [
            'bill_id' => $purchaseModel->id,
            'bill_number' => $purchaseModel->invoice_number,
            'bill_date' => $purchaseModel->bill_date,
            'debit' => $purchaseModel->total_net_amount,
            'credit' => 0,
            'narration' => '',
            'bill_type' => $type,
            'account_id' => $purchaseModel->account_id,
            'account_name' => $purchaseModel->account->name,
            'account_group_id' => $purchaseModel->account->account_group_id,
            'account_group_name' => $purchaseModel->account->accountGroup->name,
            'first_transaction_no' => $purchaseDebitInsertModel->id,
            'created_by' => authUser()->id,
        ];

        FinanceLedger::create($purchaseInsertArray);

        $accountMasterModel = AccountMaster::with('accountGroup')
            ->whereNull('created_at')
            ->whereIn('id', [$CGST_INPUT_ID, $SGST_INPUT_ID, $IGST_INPUT_ID, $ROUND_OFF, $PURCHASE_ID])
            ->get();

        if ($purchaseModel->igst > 0) {
            $accountDetailsModel = $accountMasterModel->find($IGST_INPUT_ID);
            $purchaseCreditInsertArray = [
                'bill_id' => $purchaseModel->id,
                'bill_number' => $purchaseModel->invoice_number,
                'bill_date' => $purchaseModel->bill_date,
                'debit' => $purchaseModel->total_net_amount,
                'credit' => 0,
                'narration' => '',
                'bill_type' => $type,
                'account_id' => $accountDetailsModel->id,
                'account_name' => $accountDetailsModel->name,
                'account_group_id' => $accountDetailsModel->account_group_id,
                'account_group_name' => $accountDetailsModel->accountGroup->name,
                'first_transaction_no' => $purchaseDebitInsertModel->id,
                'created_by' => authUser()->id,
            ];
            FinanceLedger::create($purchaseCreditInsertArray);
        } else if ($purchaseModel->cgst > 0) {

            $accountCGSTModel = $accountMasterModel->find($CGST_INPUT_ID);
            $accountSGSTModel = $accountMasterModel->find($SGST_INPUT_ID);
            $CGST_AND_IGST_insertArray = [
                array('bill_id' => $purchaseModel->id,
                    'bill_number' => $purchaseModel->invoice_number,
                    'bill_date' => $purchaseModel->bill_date,
                    'debit' => $purchaseModel->cgst,
                    'credit' => 0,
                    'narration' => '',
                    'bill_type' => $type,
                    'account_id' => $accountCGSTModel->id,
                    'account_name' => $accountCGSTModel->name,
                    'account_group_id' => $accountCGSTModel->account_group_id,
                    'account_group_name' => $accountCGSTModel->accountGroup->name,
                    'first_transaction_no' => $purchaseDebitInsertModel->id,
                    'created_by' => authUser()->id,
                    'created_at' => now(),
                    'updated_at' => null),
                array('bill_id' => $purchaseModel->id,
                    'bill_number' => $purchaseModel->invoice_number,
                    'bill_date' => $purchaseModel->bill_date,
                    'debit' => $purchaseModel->sgst,
                    'credit' => 0,
                    'narration' => '',
                    'bill_type' => $type,
                    'account_id' => $accountSGSTModel->id,
                    'account_name' => $accountSGSTModel->name,
                    'account_group_id' => $accountSGSTModel->account_group_id,
                    'account_group_name' => $accountSGSTModel->accountGroup->name,
                    'first_transaction_no' => $purchaseDebitInsertModel->id,
                    'created_by' => authUser()->id,
                    'created_at' => now(),
                    'updated_at' => null)
            ];

            FinanceLedger::insert($CGST_AND_IGST_insertArray);
        }

        if(!is_null($purchaseModel->round_off_value)){
            $accountROUNDOFFModel = $accountMasterModel->find($ROUND_OFF);
            $purchaseRoundOffInsertArray = [
                'bill_id' => $purchaseModel->id,
                'bill_number' => $purchaseModel->invoice_number,
                'bill_date' => $purchaseModel->bill_date,
                'debit' => 0,
                'credit' => $purchaseModel->round_off_value,
                'narration' => '',
                'bill_type' => $type,
                'account_id' => $accountROUNDOFFModel->id,
                'account_name' => $accountROUNDOFFModel->name,
                'account_group_id' => $accountROUNDOFFModel->account_group_id,
                'account_group_name' => $accountROUNDOFFModel->accountGroup->name,
                'first_transaction_no' => $purchaseDebitInsertModel->id,
                'created_by' => authUser()->id,
            ];
            FinanceLedger::create($purchaseRoundOffInsertArray);
        }

        if(!is_null($purchaseModel->tcs)){
            $TcsModel = $accountMasterModel->find($TCS_INPUT);
            $purchaseTCSInsertArray = [
                'bill_id' => $purchaseModel->id,
                'bill_number' => $purchaseModel->invoice_number,
                'bill_date' => $purchaseModel->bill_date,
                'debit' => 0,
                'credit' => $purchaseModel->total_net_amount,
                'narration' => '',
                'bill_type' => $type,
                'account_id' => $TcsModel->id,
                'account_name' => $TcsModel->name,
                'account_group_id' => $TcsModel->account_group_id,
                'account_group_name' => $TcsModel->accountGroup->name,
                'first_transaction_no' => $purchaseDebitInsertModel->id,
                'created_by' => authUser()->id,
            ];
            FinanceLedger::create($purchaseTCSInsertArray);
        }
    }
}
