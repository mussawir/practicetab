<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExerciseRequestDetail extends Model
{
    // explicitly define table and primary key
    protected $table = 'exercise_request_details';
    protected $primaryKey = 'erd_id';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'exe_id', 'er_id','status'
    ];

    public function exercise()
    {
        return $this->hasMany('App\Models\Exercise', 'exe_id');
    }

    public function exerciseRequests()
    {
        return $this->hasMany('App\Models\ExerciseRequest', 'er_id');
    }
}
