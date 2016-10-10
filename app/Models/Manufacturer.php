<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    // explicitly define table and primary key
    protected $table = 'manufacturers';
    protected $primaryKey = 'man_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'name', 'logo_image'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function supplements()
    {
        return $this->hasMany('App\Models\Supplement', 'man_id');
    }
}
