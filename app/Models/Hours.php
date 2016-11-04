<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Hours extends Authenticatable
{
    // explicitly define table and primary key
    protected $table = 'hours';
    protected $primaryKey = 'hours_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pra_id',
        'monday_open',
        'monday_close',
        'tuesday_open',
        'tuesday_close',
        'wednesday_open',
        'wednesday_close',
        'thursday_open',
        'thursday_close',
        'friday_open',
        'friday_close',
        'saturday_open',
        'saturday_close',
        'sunday_open',
        'sunday_close'
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
