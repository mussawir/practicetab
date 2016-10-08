<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    // explicitly define table and primary key
    protected $table = 'users';
    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role', 'first_name', 'last_name', 'email', 'password', 'phone', 'cell',
        'gender', 'address', 'last_login'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function practitioners()
    {
        return $this->hasMany('App\Models\Practitioner', 'user_id');
    }

    public function patients()
    {
        return $this->hasMany('App\Models\Patient', 'user_id');
    }

    public function supplements()
    {
        return $this->hasMany('App\Models\Supplement', 'user_id');
    }
}