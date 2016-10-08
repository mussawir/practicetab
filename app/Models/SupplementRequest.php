<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplementRequest extends Model
{
    // explicitly define table and primary key
    protected $table = 'supplement_requests';
    protected $primaryKey = 'sr_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pa_id', 'pra_id', 'title', 'message'
    ];

    public function patient()
    {
        return $this->belongsTo('App\Models\Patient', 'pa_id');
    }

    public function practitioner()
    {
        return $this->belongsTo('App\Models\Practitioner', 'pra_id');
    }

    public function supplementRequestDetails()
    {
        return $this->hasMany('App\Models\Supplement', 'sr_id');
    }
}
