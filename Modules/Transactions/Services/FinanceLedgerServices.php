<?php

namespace Modules\Transactions\Services;

use Modules\Transactions\Repositories\FinanceLedgerRepository;

class FinanceLedgerServices
{

    public static function saveFinanceLedger($type,$purchaseModel,$request)
    {

        $demoArray = [
            'bill_date' => $request->bill_date,
            'account_id' => $request->account_id,
            'debit' => '',
            'credit' => '',
            'narration' => '',
            'bill_number' => '',
            'bill_type' => $type,
            'bill_id ' => '',
            'account_group_id ' => '',
            'account_name' => '',
            'account_group_name' => '',
            'first_transaction_no ' => '',
            'created_by' => authUser()->id,

        ];
        return FinanceLedgerRepository::save($data);
    }
}
