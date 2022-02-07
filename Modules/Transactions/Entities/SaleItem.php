<?php

namespace Modules\Transactions\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Masters\Entities\ItemMaster;
use Modules\Transactions\Database\factories\SaleItemFactory;

class SaleItem extends Model
{
    use HasFactory;

    protected $guarded = ['id','sale_id'];
    protected $table = 'sale_items';
    protected static function newFactory()
    {
        return SaleItemFactory::new();
    }

    /**
     * @return BelongsTo
     */
    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class, 'sale_id');
    }

    /**
     * @return BelongsTo
     */
    public function item(): BelongsTo
    {
        return $this->belongsTo(ItemMaster::class, 'item_id');
    }
}
