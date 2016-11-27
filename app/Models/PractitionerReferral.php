<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PractitionerReferral extends Model
{
    // explicitly define table and primary key
    protected $table = 'practitioners_referral';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pra_id',
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
        return $this->belongsTo('App\Models\Practitioner', 'pra_id');
    }
}
