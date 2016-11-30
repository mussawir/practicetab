<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplementRequestDetail extends Model
{
    // explicitly define table and primary key
    protected $table = 'supplement_request_details';
    protected $primaryKey = 'srd_id';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sup_id', 'sr_id', 'status'
    ];

    public function supplements()
    {
        return $this->hasMany('App\Models\Supplement', 'sup_id');
    }

    public function supplementRequests()
    {
        return $this->hasMany('App\Models\SupplementRequest', 'sr_id');
    }
}
