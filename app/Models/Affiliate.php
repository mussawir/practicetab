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
        'email',
        'created_by',       // member id if by member
        'affiliate_type',   // 1=direct, 2=by member
        'is_paid',          // 0=free, 1=paid
        'message'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
