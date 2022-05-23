<?php

namespace App\Models;

use Database\Factories\CompanyFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * App\Models\Company
 *
 * @property int $id
 * @property string $name
 * @property string $logo
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static CompanyFactory factory(...$parameters)
 * @method static Builder|Company newModelQuery()
 * @method static Builder|Company newQuery()
 * @method static Builder|Company query()
 * @method static Builder|Company whereCreatedAt($value)
 * @method static Builder|Company whereId($value)
 * @method static Builder|Company whereLogo($value)
 * @method static Builder|Company whereName($value)
 * @method static Builder|Company whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Company extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * @return Collection
     */
    public static function getCompanies(): Collection
    {
        return Self::pluck('name', 'id');
    }

    public function getToDateAttribute($value){
        return Carbon::parse($value)->format('d-m-Y');
    }

    public function getFromDateAttribute($value){
        return Carbon::parse($value)->format('d-m-Y');
    }
}
