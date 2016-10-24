<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exercises extends Model
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
        'user_id', 'heading', 'description','image1',
        'image2', 'execat_id'  ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function manufacturer()
    {
        return $this->belongsTo('App\Models\Manufacturer', 'man_id');
    }
}
