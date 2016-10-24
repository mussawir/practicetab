<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Practitioner extends Authenticatable
{
    // explicitly define table and primary key
    protected $table = 'practitioners';
    protected $primaryKey = 'pra_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pra_id',
        'user_id',
        'plan_type',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'photo',
        'primary_phone',
        'secondary_phone',
        'mailing_street_address',
        'mailing_city',
        'mailing_zip',
        'billing_street_address',
        'billing_city',
        'billing_zip',
        'mailing_state',
        'billing_state',
        'office_phone',
        'office_street_address',
        'office_city',
        'office_zip',
        'office_state',
        'notes',
        'password',
        'inactive',
        'cc_profile_id',
        'directory_name'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function patient()
    {
        return $this->hasMany('App\Models\Patient', 'pa_id');
    }
}
