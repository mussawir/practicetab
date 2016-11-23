<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminContacts extends Model
{
    // explicitly define table and primary key
    protected $table = 'admin_contacts';
    protected $primaryKey = 'cnt_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'first_name', 'last_name', 'primary_phone', 'cell', 'address', 'email',
        'photo', 'note', 'status'
    ];

    public function contactInGroup()
    {
        return $this->hasMany('App\Models\AdminInGroup', 'cnt_id');
    }
}
