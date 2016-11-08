<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailGroup extends Model
{
    // explicitly define table and primary key
    protected $table = 'email_groups';
    protected $primaryKey = 'cg_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pra_id', 'name'
    ];

    public function practitioner()
    {
        return $this->belongsTo('App\Models\Practitioner', 'pra_id');
    }

    public function emailIngroup()
    {
        return $this->hasMany('App\Models\EmailInGroup', 'cg_id');
    }
}
