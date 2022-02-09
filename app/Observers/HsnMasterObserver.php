<?php

namespace App\Observers;

use Modules\Masters\Entities\HsnMaster;



class HsnMasterObserver
{
    /**
     * Handle the Product "created" event.
     *
     * @param HsnMaster $hsn
     * @return void
     */
    public function creating(HsnMaster $hsn)
    {
        $hsn->company_id = authCompany()->id;
    }

    /**
     * @param HsnMaster $hsn
     * @return void
     */
    public function updating(HsnMaster $hsn)
    {
        $hsn->company_id = authCompany()->id;
    }
}
