<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\UserFormula
 *
 * @property int $user_id
 * @property int $formula_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|UserFormula newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserFormula newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserFormula query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserFormula whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserFormula whereFormulaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserFormula whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserFormula whereUserId($value)
 *
 * @mixin \Eloquent
 */
class UserFormula extends Pivot
{
    //
}
