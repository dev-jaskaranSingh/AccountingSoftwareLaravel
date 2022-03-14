<?php

namespace App\Observers;

use Modules\Transactions\Entities\SaleReturn;

class SaleReturnObserver
{

    /**
     * Handle the Product "created" event.
     *
     * @param SaleReturn $sales_return
     * @return void
     */
    public function creating(SaleReturn $sales_return)
    {
        $sales_return->company_id = authCompany()->id;
    }

    /**
     * @param SaleReturn $sales_return
     * @return void
     */
    public function updating(SaleReturn $sales_return)
    {
        $sales_return->company_id = authCompany()->id;
    }
}
