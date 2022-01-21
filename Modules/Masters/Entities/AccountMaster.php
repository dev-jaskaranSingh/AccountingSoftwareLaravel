<?php

namespace Modules\Masters\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Masters\Database\factories\AccountMasterFactory;

class AccountMaster extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected static function newFactory()
    {
        return AccountMasterFactory::new();
    }

    public function accountGroup()
    {
        return $this->belongsTo(AccountGroup::class);
    }
}
