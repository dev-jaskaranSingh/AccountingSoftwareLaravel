<?php

namespace Modules\Masters\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Masters\Database\factories\AccountGroupFactory;

class AccountGroup extends Model
{
    use HasFactory;

    protected $fillable = ['name','is_primary','sub_group_id','sub_group_name','category_group'];

    protected static function newFactory()
    {
        return AccountGroupFactory::new();
    }

    public function setIsPrimaryAttribute($value)
    {
        $this->attributes['is_primary'] = (boolean) $value == 'on' ? 1 : 0;
    }

    public function subGroup()
    {
        return $this->belongsTo('Modules\Masters\Entities\AccountGroup','sub_group_id');
    }


}
