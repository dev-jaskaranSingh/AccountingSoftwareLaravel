<?php

namespace App\Observers;


use Modules\Transactions\Entities\Purchase;

class PurchaseObserver
{
    /**
     * Handle the Product "created" event.
     *
     * @param Purchase $purchase
     * @return void
     */
    public function creating(Purchase $purchase)
    {
        $purchase->company_id = authCompany()->id;
    }

    /**
     * @param Purchase $purchase
     * @return void
     */
    public function updating(Purchase $purchase)
    {
        $purchase->company_id = authCompany()->id;
    }
}
