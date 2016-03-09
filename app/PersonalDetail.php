<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\PersonalDetail
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $first_surname
 * @property string $last_surname
 * @property integer $ci
 * @property string $phone
 * @property string $cellphone
 * @property \Carbon\Carbon $birthday
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\User $user
 * @property-read \App\Professor $professor
 * @method static \Illuminate\Database\Query\Builder|\App\PersonalDetail whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PersonalDetail whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PersonalDetail whereFirstName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PersonalDetail whereLastName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PersonalDetail whereFirstSurname($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PersonalDetail whereLastSurname($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PersonalDetail whereCi($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PersonalDetail wherePhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PersonalDetail whereCellphone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PersonalDetail whereBirthday($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PersonalDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PersonalDetail whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PersonalDetail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'first_surname',
        'last_surname',
        'ci',
        'phone',
        'cellphone',
        'birthday',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $dates = [
        'birthday'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function professor()
    {
        return $this->hasOne(Professor::class);
    }
}
