<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactInGroup extends Model
{
    // explicitly define table and primary key
    protected $table = 'contacts_in_groups';
    protected $primaryKey = 'cgd_id';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cg_id', 'cnt_id'
    ];

    public function contactGroups()
    {
        return $this->belongsTo('App\Models\ContactGroup', 'cg_id');
    }

    public function contacts()
    {
        return $this->belongsTo('App\Models\Contact', 'cnt_id');
    }
}
