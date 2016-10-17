<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expercises extends Model
{
    // explicitly define table and primary key
    protected $table = 'exercises';
    protected $primaryKey = 'exe_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'heading', 'short_description', 'content','main_image',
        'banner_image', 'banner_v_link'
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
