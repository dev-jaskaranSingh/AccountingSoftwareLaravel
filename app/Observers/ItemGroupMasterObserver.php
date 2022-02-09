<?php

namespace App\Observers;

use Modules\Masters\Entities\ItemGroupMaster;


class ItemGroupMasterObserver
{
    /**
     * Handle the Product "created" event.
     *
     * @param ItemGroupMaster $itemGroupMaster
     * @return void
     */
    public function creating(ItemGroupMaster $itemGroupMaster)
    {
        $itemGroupMaster->company_id = authCompany()->id;
    }

    /**
     * @param ItemGroupMaster $itemGroupMaster
     * @return void
     */
    public function updating(ItemGroupMaster $itemGroupMaster)
    {
        $itemGroupMaster->company_id = authCompany()->id;
    }
}
