<?php

namespace Modules\Transactions\Repositories;

use Modules\Transactions\Entities\StockMaster;

class StockMasterRepository
{
    /**
     * @param $stockMasterData
     * @return void
     */
    public static function save($stockMasterData){
        return StockMaster::insert($stockMasterData->toArray());
    }
}
