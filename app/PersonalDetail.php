<?php

namespace App;

use Carbon\Carbon;
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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Event[] $events
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
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $dates = [
        'birthday',
    ];

    /**
     * Nos interesa guardar la fecha sin las horas y minutos.
     *
     * @param string $value la fecha a guardar
     * @return Carbon
     */
    public function setBirthdayAttribute($value)
    {
        return $this->attributes['birthday'] =
            Carbon::createFromFormat('Y-m-d', $value);
    }

    /**
     * Nos interesa obtener la fecha sin las horas y minutos.
     *
     * @param $value
     * @return string
     */
    public function getBirthdayAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo|\Illuminate\Database\Query\Builder
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany|\Illuminate\Database\Query\Builder
     */
    public function events()
    {
        return $this->belongsToMany(Event::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne|\Illuminate\Database\Query\Builder
     */
    public function professor()
    {
        return $this->hasOne(Professor::class);
    }

    /**
     * Genera los nombres en formato legible para
     * ser consumido por alguna vista.
     *
     * @param boolean $everything chequea si se trae los nombres secundarios.
     * @return string
     */
    public function formattedNames($everything = null)
    {
        $firstName    = ucfirst($this->attributes['first_name']);
        $firstSurname = ucfirst($this->attributes['first_surname']);

        // si everything no es nulo entonces
        // se desea los nombres y apellidos.
        if (is_null($everything)) {
            return "{$firstSurname}, {$firstName}";
        }

        return $this->formattedNamesWithLast($firstSurname, $firstName);
    }

    /**
     * Genera los nombres en formato legible con los nombres y apellidos.
     *
     * @param string $firstSurname El primer apellido.
     * @param string $firstName El primer nombre.
     * @return string los apellidos, nombres.
     */
    private function formattedNamesWithLast($firstSurname, $firstName)
    {
        $lastName    = isset($this->attributes['last_name']) ?
            ucfirst($this->attributes['last_name']) : '';
        $lastSurName = isset($this->attributes['last_surname']) ?
            ucfirst($this->attributes['last_surname']) : '';

        $surnames = trim("{$firstSurname} {$lastSurName}");
        $names    = trim("{$firstName} {$lastName}");

        return "{$surnames}, {$names}";
    }
}
