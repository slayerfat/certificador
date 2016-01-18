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
