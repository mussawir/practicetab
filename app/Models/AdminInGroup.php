<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminInGroup extends Model
{
    // explicitly define table and primary key
    protected $table = 'admin_contacts_groups';
    protected $primaryKey = 'egd_id';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ag_id', 'cnt_id'
    ];

    public function contactGroups()
    {
        return $this->belongsTo('App\Models\AdminGroup', 'ag_id');
    }

    public function contacts()
    {
        return $this->belongsTo('App\Models\AdminContacts', 'cnt_id');
    }
}
