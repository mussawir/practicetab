<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Patient extends Authenticatable
{
    // explicitly define table and primary key
    protected $table = 'patients';
    protected $primaryKey = 'pa_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pa_id',
        'user_id',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'photo',
        'date_of_birth',
        'age',
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
        'notes',
        'password',
        'paid',
        'is_subscribed',
        'inactive',
        'cc_type',
        'cc_number',
        'cc_month',
        'cc_year',
        'cc_cvv',

    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
//Use this function everywhere, where we have parent child table reltionship
    public function practitioner()
    {
        return $this->belongsTo('App\Models\Practitioner', 'pra_id');
    }
}
