<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailInGroup extends Model
{
    // explicitly define table and primary key
    protected $table = 'email_in_groups';
    protected $primaryKey = 'egd_id';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'email', 'cg_id', 'first_name', 'middle_name', 'last_name', 'primary_phone', 'type'
    ];

    public function contactGroups()
    {
        return $this->belongsTo('App\Models\EmailGroup', 'cg_id');
    }

}
