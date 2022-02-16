<?php

namespace Modules\Transactions\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Transactions\Database\factories\SaleFactory;

/**
 * @method static insert($toArray)
 */
class StockMaster extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'stock_master';


}
