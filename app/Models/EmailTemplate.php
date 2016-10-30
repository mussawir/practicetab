<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    // explicitly define table and primary key
    protected $table = 'email_templates';
    protected $primaryKey = 'et_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pra_id',
        'name',
        'template',
    ];

    public function practitioners()
    {
        return $this->belongsTo('App\Models\Practitioner', 'pra_id');
    }
}
