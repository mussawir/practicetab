<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExercisePresDetails extends Model
{
    // explicitly define table and primary key
    protected $table = 'exercise_pres_details';
    protected $primaryKey = 'id';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'master_id', 'notes', 'sets', 'reps', 'weight',
        'hold', 'rest', 'duration', 'exe_id'
    ];


    public function exercisePresMaster()
    {
        return $this->belongsTo('App\Models\ExercisePresMaster', 'id');
    }
}
