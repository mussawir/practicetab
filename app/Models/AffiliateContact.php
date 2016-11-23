<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AffiliateContact extends Model
{
    // explicitly define table and primary key
    protected $table = 'affiliate_contacts';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'afi_id',
        'first_name',
        'last_name',
        'phone',
        'email'
    ];

    public function affiliate()
    {
        return $this->belongsTo('App\Models\Affiliate', 'afi_id');
    }
}
