<?php

namespace Modules\Transactions\Repositories;

use Modules\Transactions\Entities\FinanceLedger;


class FinanceLedgerRepository
{

    /**
     * @return int
     */
    public static function getMaxFinanceLedgerId(): int
    {
        return FinanceLedger::max('id') ?? 0;
    }

    public static function getMaxBillNumberByBillType($billType)
    {
        return FinanceLedger::where('bill_type', $billType)->max('bill_number') ?? 0;
    }

    public static function saveInFinanceLedger($insertData)
    {
        return FinanceLedger::insert($insertData);

    }

}
