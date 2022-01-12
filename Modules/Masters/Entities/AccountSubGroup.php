<?php

namespace Modules\Masters\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccountSubGroup extends Model
{
    use HasFactory;

    protected $fillable = ['parent_id','child_id'];
    protected $table = 'account_sub_group';

    protected static function newFactory()
    {
        return \Modules\Masters\Database\factories\AccountSubGroupFactory::new();
    }
}
