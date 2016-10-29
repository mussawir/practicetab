<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NutSuggestionsDetails extends Model
{
    // explicitly define table and primary key
    protected $table = 'nut_sugest_details';
    protected $primaryKey = 'id';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'master_id', 'pa_id', 'nut_id'
    ];


    public function supSuggestionsMaster()
    {
        return $this->belongsTo('App\Models\NutSuggestionsMaster', 'id');
    }
}
