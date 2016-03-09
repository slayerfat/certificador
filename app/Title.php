<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Title
 *
 * @property integer $id
 * @property string $desc
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Professor[] $professor
 * @method static \Illuminate\Database\Query\Builder|\App\Title whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Title whereDesc($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Title whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Title whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Title extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'desc',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function professor()
    {
        return $this->hasMany(Professor::class);
    }
}