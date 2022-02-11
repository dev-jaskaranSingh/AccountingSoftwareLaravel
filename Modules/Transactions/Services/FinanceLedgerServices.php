<?php

namespace Modules\Transactions\Services;

use Modules\Transactions\Repositories\FinanceLedgerRepository;

class FinanceLedgerServices
{

    public static function saveFinanceLedger($data)
    {
        return FinanceLedgerRepository::save($data);
    }
}
