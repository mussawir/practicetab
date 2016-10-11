<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactGroup extends Model
{
    // explicitly define table and primary key
    protected $table = 'contact_groups';
    protected $primaryKey = 'cg_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pra_id', 'name', 'description'
    ];

    public function practitioner()
    {
        return $this->belongsTo('App\Models\Practitioner', 'pra_id');
    }

    public function contactInGroup()
    {
        return $this->hasMany('App\Models\ContactInGroup', 'cg_id');
    }
}
