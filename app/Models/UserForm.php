<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\UserForm
 *
 * @property int $id
 * @property int $user_id
 * @property int $form_id
 * @property int $create
 * @property int $read
 * @property int $update
 * @property int $delete
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Form $forms
 * @property-read \App\Models\User $users
 * @method static \Database\Factories\UserFormFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|UserForm newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserForm newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserForm query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserForm whereCreate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserForm whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserForm whereDelete($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserForm whereFormId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserForm whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserForm whereRead($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserForm whereUpdate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserForm whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserForm whereUserId($value)
 * @mixin \Eloquent
 */
class UserForm extends Model
{
    use HasFactory;

    /**
     * @return BelongsTo
     */
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function forms(): BelongsTo
    {
        return $this->belongsTo(Form::class);
    }
}
