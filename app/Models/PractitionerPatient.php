<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PractitionerPatient extends Model
{
    // explicitly define table and primary key
    protected $table = 'pra_pa';
    protected $primaryKey = 'prapa_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pra_id',
        'pa_id'
    ];

    public function practitioners()
    {
        return $this->belongsTo('App\Models\Practitioner', 'pra_id');
    }

    public function patients()
    {
        return $this->belongsTo('App\Models\Patient', 'pa_id');
    }
}
