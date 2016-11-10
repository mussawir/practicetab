<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Temp extends Model
{
    // explicitly define table and primary key
    protected $table = 'temp';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'type', 'first_name', 'last_name', 'primary_phone'
    ];


}
