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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Professor[] $professors
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
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * Modifica la descripcion para que siempre sea mayuscula la primera letra.
     *
     * @param $value
     * @return string
     */
    public function setDescAttribute($value)
    {
        return $this->attributes['desc'] = ucfirst($value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|\Illuminate\Database\Query\Builder
     */
    public function professors()
    {
        return $this->hasMany(Professor::class);
    }
}
