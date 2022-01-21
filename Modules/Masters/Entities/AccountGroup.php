<?php

namespace Modules\Masters\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Masters\Database\factories\AccountGroupFactory;

class AccountGroup extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'is_primary'];
    protected $casts = ['is_primary' => 'boolean'];
    protected $hidden = ['created_at','updated_at'];

    protected static function newFactory()
    {
        return AccountGroupFactory::new();
    }

    public function setIsPrimaryAttribute($value)
    {
        $this->attributes['is_primary'] = ($value === 'on') ? 1 : 0;
    }


    public function children(): BelongsToMany
    {
        return $this->belongsToMany(AccountGroup::class, 'account_sub_groups', 'parent_id', 'child_id')->with('children');
    }

    public function parent(): BelongsToMany
    {
        return $this->belongsToMany(AccountGroup::class, 'account_sub_groups', 'child_id', 'parent_id')->with('parent');
    }


}
