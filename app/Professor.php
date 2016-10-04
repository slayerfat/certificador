<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Professor
 *
 * @property integer $id
 * @property integer $personal_detail_id
 * @property integer $title_id
 * @property string $position
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\PersonalDetail $personalDetails
 * @property-read \App\Title $title
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Institute[] $institutes
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Event[] $events
 * @method static \Illuminate\Database\Query\Builder|\App\Professor whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Professor whereLeads($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Professor wherePersonalDetailId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Professor whereTitleId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Professor wherePosition($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Professor whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Professor whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Professor extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'position',
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
     * Modifica la posicion para que siempre sea mayuscula la primera letra.
     *
     * @param $value
     * @return string
     */
    public function setPositionAttribute($value)
    {
        return $this->attributes['position'] = ucfirst($value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|\Illuminate\Database\Query\Builder
     */
    public function personalDetails()
    {
        return $this->belongsTo(PersonalDetail::class, 'personal_detail_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|\Illuminate\Database\Query\Builder
     */
    public function title()
    {
        return $this->belongsTo(Title::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany|\Illuminate\Database\Query\Builder|\App\Institute
     */
    public function institutes()
    {
        return $this->belongsToMany(Institute::class)->withPivot('leads', 'position');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany|\Illuminate\Database\Query\Builder
     */
    public function events()
    {
        return $this->belongsToMany(Event::class)->withPivot('position');
    }
}
