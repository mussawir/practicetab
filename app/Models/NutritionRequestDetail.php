<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NutritionRequestDetail extends Model
{
    // explicitly define table and primary key
    protected $table = 'nutrition_request_details';
    protected $primaryKey = 'nrd_id';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nut_id', 'nr_id'
    ];

    public function nutrition()
    {
        return $this->hasMany('App\Models\Nutrition', 'nut_id');
    }

    public function nutritionRequests()
    {
        return $this->hasMany('App\Models\NutritionRequest', 'nr_id');
    }
}
