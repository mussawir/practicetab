<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplement extends Model
{
    // explicitly define table and primary key
    protected $table = 'supplements';
    protected $primaryKey = 'sup_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'name', 'short_description', 'long_description', 'man_id',
        'used_for', 'url', 'how_to_get', 'benefits', 'usability', 'main_image',
        'main_price', 'discount'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function manufacturer()
    {
        return $this->belongsTo('App\Models\Manufacturer', 'man_id');
    }
}
