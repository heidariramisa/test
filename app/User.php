<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $mobile
 * @property string $email_verified_at
 * @property string $password
 * @property boolean $admin
 * @property string $remember_token
 * @property string $created_at
 * @property string $updated_at
 * @property Todo[] $todos
 */
class User extends Authenticatable implements JWTSubject ,MustVerifyEmail
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'email', 'mobile', 'email_verified_at', 'password', 'admin', 'remember_token', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function todos()
    {
        return $this->hasMany('App\Todo');
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

}
