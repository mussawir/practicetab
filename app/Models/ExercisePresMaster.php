<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExercisePresMaster extends Model
{
    // explicitly define table and primary key
    protected $table = 'exercise_pres_masters';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'pra_id', 'pa_id'
    ];

    public function exercisePresDetails()
    {
        return $this->hasMany('App\Models\ExercisePresDetails', 'master_id');
    }
}
