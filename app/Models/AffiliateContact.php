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
        'email',
        'message',
        'is_paid',          // 0=free, 1=paid
        'invitation_count', // record the count of invitations
        'last_invite_at',   // record last invitation date and time
    ];

    public function affiliate()
    {
        return $this->belongsTo('App\Models\Affiliate', 'afi_id');
    }
}
