<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplementPresDetails extends Model
{
    // explicitly define table and primary key
    protected $table = 'sup_pres_details';
    protected $primaryKey = 'id';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'master_id', 'sup_id', 'notes', 'age', 'dosage', 'weight',
        'forms', 'use', 'start_date', 'stop_date'
    ];


    public function supplementPresMaster()
    {
        return $this->belongsTo('App\Models\SupplementPresMaster', 'id');
    }
}
