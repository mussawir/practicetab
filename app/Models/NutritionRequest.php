<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NutritionRequest extends Model
{
    // explicitly define table and primary key
    protected $table = 'nutrition_requests';
    protected $primaryKey = 'nr_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pa_id', 'pra_id', 'title', 'message', 'status'
    ];

    public function patient()
    {
        return $this->belongsTo('App\Models\Patient', 'pa_id');
    }

    public function practitioner()
    {
        return $this->belongsTo('App\Models\Practitioner', 'pra_id');
    }

    public function nutritionRequestDetails()
    {
        return $this->hasMany('App\Models\Supplement', 'nr_id');
    }
}
