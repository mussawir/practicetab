<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailAdminContacts extends Model
{
    // explicitly define table and primary key
    protected $table = 'admin_in_groups';
    protected $primaryKey = 'ag_id';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'ag_id', 'first_name', 'middle_name', 'last_name', 'primary_phone', 'type', 'group_name', 'user_id'
    ];

    public function adminGroups()
    {
        return $this->belongsTo('App\Models\AdminGroup', 'ag_id');
    }

}
