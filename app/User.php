<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;


/**
 * App\User
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property boolean $admin
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $personal_details_id
 * @property-read \App\PersonalDetail $personalDetails
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Event[] $events
 * @method static \Illuminate\Database\Query\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereAdmin($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePersonalDetailsId($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'admin',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'admin',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function personalDetails()
    {
        return $this->hasOne(PersonalDetail::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function events()
    {
        return $this->belongsToMany(Event::class);
    }

    /**
     * helper para ver si es admin o si puede manipular algun recurso.
     *
     * @param int $id el foreign key del recurso.
     * @return boolean
     */
    public function isOwnerOrAdmin($id)
    {
        return boolval($this->attributes['admin']) || $this->isOwner($id);
    }

    /**
     * chequea si el id del foreign key del recurso es igual al id del usuario,
     * en otras palabras, verifica que el usuario pueda modificar
     * algun recurso viendo si le pertenece o no.
     *
     * @param int $id el foreign key del recurso.
     * @return boolean
     */
    public function isOwner($id)
    {
        if (is_null($id)) {
            return false;
        }
        if (isset($this->attributes['id'])) {
            return $this->attributes['id'] == $id;
        }

        return false;
    }
}
