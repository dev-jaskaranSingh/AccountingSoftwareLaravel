<?php

namespace Modules\Masters\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ItemSubGroup extends Model
{
    use HasFactory;

    protected $fillable = ['parent_id','child_id'];
    
    protected static function newFactory()
    {
        return \Modules\Masters\Database\factories\ItemSubGroupFactory::new();
    }
}
