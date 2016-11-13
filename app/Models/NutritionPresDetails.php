<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NutritionPresDetails extends Model
{
    // explicitly define table and primary key
    protected $table = 'nut_pres_details';
    protected $primaryKey = 'id';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'master_id', 'nut_id', 'notes', 'age', 'weight', 'use'
    ];


    public function nutritionPresMaster()
    {
        return $this->belongsTo('App\Models\NutritionPresMaster', 'id');
    }
}
