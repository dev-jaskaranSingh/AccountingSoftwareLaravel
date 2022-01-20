<?php

namespace Modules\Masters\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Masters\Database\factories\ItemGroupMasterFactory;

class ItemGroupMaster extends Model
{
    use HasFactory;

    protected $table = 'items_group_master';
    protected $fillable = ['name','is_primary'];

    protected static function newFactory()
    {
        return ItemGroupMasterFactory::new();
    }
    public function setIsPrimaryAttribute($value)
    {
        $this->attributes['is_primary'] = ($value == 'on') ? 0 : 1;
    }


    public function children(): BelongsToMany
    {
        return $this->belongsToMany(ItemGroupMaster::class, 'item_sub_groups', 'parent_id', 'child_id')->with('children');
    }

    public function parent(): BelongsToMany
    {
        return $this->belongsToMany(ItemGroupMaster::class, 'item_sub_groups', 'child_id', 'parent_id')->with('parent');
    }
}
