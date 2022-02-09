<?php

namespace App\Observers;

use Modules\Masters\Entities\ItemMaster;

class ItemMasterObserver
{
    /**
     * Handle the Product "created" event.
     *
     * @param ItemMaster $itemMaster
     * @return void
     */
    public function creating(ItemMaster $itemMaster)
    {
        $itemMaster->company_id = authCompany()->id;
    }

    /**
     * @param ItemMaster $itemMaster
     * @return void
     */
    public function updating(ItemMaster $itemMaster)
    {
        $itemMaster->company_id = authCompany()->id;
    }
}
