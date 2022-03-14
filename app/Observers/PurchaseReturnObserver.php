<?php

namespace App\Observers;


use Modules\Transactions\Entities\PurchaseReturn;

class PurchaseReturnObserver
{
    /**
     * Handle the Product "created" event.
     *
     * @param PurchaseReturn $purchases_return
     * @return void
     */
    public function creating(PurchaseReturn $purchases_return)
    {
        $purchases_return->company_id = authCompany()->id;
    }

    /**
     * @param PurchaseReturn $purchases_return
     * @return void
     */
    public function updating(PurchaseReturn $purchases_return)
    {
        $purchases_return->company_id = authCompany()->id;
    }

    /**
     * @param PurchaseReturn $purchases_return
     * @return void
     */
    public function saving(PurchaseReturn $purchases_return)
    {
        $purchases_return->company_id = authCompany()->id;
    }
}
