<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Form extends Model
{
    use HasFactory;
    protected  $fillable = ['name', 'form_group'];
    protected  $with = ['users'];

    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, UserForm::class, 'form_id', 'user_id');
    }
}
