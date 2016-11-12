<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NutritionPresMaster extends Model
{
    // explicitly define table and primary key
    protected $table = 'nut_pres_masters';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pra_id', 'pa_id', 'prescribed_at', 'trashed_at'
    ];

    public function nutritionPresDetails()
    {
        return $this->hasMany('App\Models\NutritionPresDetails', 'master_id');
    }
}
