<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    // explicitly define table and primary key
    protected $table = 'contacts';
    protected $primaryKey = 'cnt_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pra_id', 'first_name', 'last_name', 'phone', 'cell', 'address', 'email',
        'photo', 'note', 'status'
    ];

    public function practitioner()
    {
        return $this->belongsTo('App\Models\Practitioner', 'pra_id');
    }

    public function contactInGroup()
    {
        return $this->hasMany('App\Models\ContactInGroup', 'cnt_id');
    }
}
