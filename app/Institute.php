<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Institute
 *
 * @property integer $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Professor[] $professors
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Event[] $events
 * @method static \Illuminate\Database\Query\Builder|\App\Institute whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Institute whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Institute whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Institute whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Institute extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
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
     * La primera letra debera estar capitalizada en el nombre.
     *
     * @param $value
     * @return string
     */
    public function setNameAttribute($value)
    {
        return $this->attributes['name'] = ucfirst($value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function professors()
    {
        return $this->belongsToMany(Professor::class)->withPivot('leads');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
