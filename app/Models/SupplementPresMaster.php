<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplementPresMaster extends Model
{
    // explicitly define table and primary key
    protected $table = 'sup_pres_masters';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pra_id', 'pa_id', 'prescribed_at', 'trashed_at'
    ];

    public function supplementPresDetails()
    {
        return $this->hasMany('App\Models\SupplementPresDetails', 'master_id');
    }
}
