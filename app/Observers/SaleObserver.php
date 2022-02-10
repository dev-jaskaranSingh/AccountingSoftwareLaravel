<?php

namespace App\Observers;


use Modules\Transactions\Entities\StockMaster;

class SaleObserver
{

    /**
     * Handle the Product "created" event.
     *
     * @param StockMaster $sale
     * @return void
     */
    public function creating(StockMaster $sale)
    {
        $sale->company_id = authCompany()->id;
    }

    /**
     * @param StockMaster $sale
     * @return void
     */
    public function updating(StockMaster $sale)
    {
        $sale->company_id = authCompany()->id;
    }
}
