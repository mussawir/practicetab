<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Execategories extends Model
{
    // explicitly define table and primary key
    protected $table = 'exe_categories';
    protected $primaryKey = 'execat_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'category', 'cat_image'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

   }
