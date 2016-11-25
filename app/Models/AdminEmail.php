<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminEmail extends Model
{
    // explicitly define table and primary key
    protected $table = 'admin_emails';
    protected $primaryKey = 'ae_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'sent_to',
        'subject',
        'message',
        'attachment',
        'group_name'
    ];

    public function admins()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
