<?php

namespace App\Observers;


use Modules\Transactions\Entities\Stock;

class StockObserver
{
    /**
     * Handle the Product "created" event.
     *
     * @param Stock stock
     * @return void
     */
    public function creating(Stock $stock)
    {
        $stock->company_id = authCompany()->id;
    }

    /**
     * @param Stock stock
     * @return void
     */
    public function updating(Stock $stock)
    {
        $stock->company_id = authCompany()->id;
    }

    /**
     * @param Stock stock
     * @return void
     */
    public function saving(Stock $stock)
    {
        $stock->company_id = authCompany()->id;
    }
}
