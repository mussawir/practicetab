<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class PatientFile extends Authenticatable
{
    // explicitly define table and primary key
    protected $table = 'patient_files';
    protected $primaryKey = 'pf_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pa_id',
        'pra_id',
        'file_name'
    ];


//Use this function everywhere, where we have parent child table reltionship
    public function patient()
    {
        return $this->belongsTo('App\Models\Patient', 'pa_id');
    }
}
