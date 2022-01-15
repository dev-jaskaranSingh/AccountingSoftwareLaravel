<?php

namespace Modules\Masters\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Masters\Database\factories\ItemGroupMasterFactory;

class ItemGroupMaster extends Model
{
    use HasFactory;

    protected $table = 'items_group_master';
    protected $fillable = ['name'];

    protected static function newFactory()
    {
        return ItemGroupMasterFactory::new();
    }
}
