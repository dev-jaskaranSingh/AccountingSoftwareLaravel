<?php

namespace App\Observers;


use Modules\Transactions\Entities\Sale;

class SaleObserver
{

    /**
     * Handle the Product "created" event.
     *
     * @param Sale $sale
     * @return void
     */
    public function creating(Sale $sale)
    {
        $sale->company_id = authCompany()->id;
    }

    /**
     * @param Sale $sale
     * @return void
     */
    public function updating(Sale $sale)
    {
        $sale->company_id = authCompany()->id;
    }
}
