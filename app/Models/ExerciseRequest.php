<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExerciseRequest extends Model
{
    // explicitly define table and primary key
    protected $table = 'exercise_requests';
    protected $primaryKey = 'er_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pa_id', 'pra_id', 'title', 'message','status'
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
        return $this->hasMany('App\Models\ExerciseRequestDetail', 'er_id');
    }
}
