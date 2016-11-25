<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Affiliate extends Model
{
    // explicitly define table and primary key
    protected $table = 'affiliates';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'phone',
        'email'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function affiliate_contacts()
    {
        return $this->hasMany('App\Models\AffiliateContact', 'afi_id');
    }
}
