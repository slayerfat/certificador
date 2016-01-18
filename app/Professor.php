<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Professor
 *
 * @property integer $id
 * @property integer $personal_details_id
 * @property integer $title_id
 * @property string $position
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\PersonalDetail $personalDetails
 * @property-read \App\Title $title
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Institute[] $institutes
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function personalDetails()
    {
        return $this->belongsTo(PersonalDetail::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function title()
    {
        return $this->belongsTo(Title::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function institutes()
    {
        return $this->belongsToMany(Institute::class)->withPivot('leads');
    }
}
