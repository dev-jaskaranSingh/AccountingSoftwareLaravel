<?php

namespace Modules\Masters\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Masters\Database\factories\UnitMasterFactory;

class UnitMaster extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    protected $table = 'units_master';

    protected static function newFactory()
    {
        return UnitMasterFactory::new();
    }
}
