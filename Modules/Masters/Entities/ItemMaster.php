<?php

namespace Modules\Masters\Entities;

use App\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Masters\Database\factories\ItemMasterFactory;

class ItemMaster extends Model
{
    use HasFactory;

    protected $table = 'items_master';
    protected $guarded = ['id'];

    protected static function newFactory()
    {
        return ItemMasterFactory::new();

    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }

    /**
     * @return BelongsTo
     */
    public function unit(): BelongsTo
    {
        return $this->belongsTo(UnitMaster::class, 'unit_id');
    }

    /**
     * @return BelongsTo
     */
    public function itemGroup(): BelongsTo
    {
        return $this->belongsTo(ItemGroupMaster::class, 'item_group_id');
    }

    /**
     * @return BelongsTo
     */
    public function hsn(): BelongsTo
    {
        return $this->belongsTo(HsnMaster::class, 'hsn_id');
    }

}
