<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminGroup extends Model
{
    // explicitly define table and primary key
    protected $table = 'admin_groups';
    protected $primaryKey = 'ag_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'name', 'description'
    ];


    public function adminInGroup()
    {
        return $this->hasMany('App\Models\AdminInGroup', 'ag_id');
    }
}
