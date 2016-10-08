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
        'name', 'short_description', 'long_description', 'manufacturer_id', 'used_for'
    ];
}
