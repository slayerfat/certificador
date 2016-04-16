<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Event
 *
 * @property integer $id
 * @property integer $institute_id
 * @property string $name
 * @property integer $hours
 * @property string $content
 * @property \Carbon\Carbon $date
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Institute $institute
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\PersonalDetail[] $attendants
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Professor[] $professors
 * @method static \Illuminate\Database\Query\Builder|\App\Event whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Event whereInstituteId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Event whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Event whereHours($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Event whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Event whereDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Event whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Event whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Event extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'content',
        'hours',
        'date',
        'location',
        'info',
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
     * @var array
     */
    protected $dates = ['date'];

    /**
     * Nos interesa guardar la fecha sin las horas y minutos.
     *
     * @param string $value la fecha a guardar
     * @return Carbon
     */
    public function setDateAttribute($value)
    {
        return $this->attributes['date'] =
            Carbon::createFromFormat('Y-m-d', $value);
    }

    /**
     * Nos interesa obtener la fecha sin las horas y minutos.
     *
     * @param $value
     * @return string
     */
    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|\Illuminate\Database\Query\Builder
     */
    public function institute()
    {
        return $this->belongsTo(Institute::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany|\Illuminate\Database\Query\Builder
     */
    public function attendants()
    {
        return $this->belongsToMany(PersonalDetail::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany|\Illuminate\Database\Query\Builder
     */
    public function professors()
    {
        return $this->belongsToMany(Professor::class)->withPivot('position');
    }
}
