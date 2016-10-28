<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupSuggestionsDetails extends Model
{
    // explicitly define table and primary key
    protected $table = 'sup_sugest_details';
    protected $primaryKey = 'id';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'master_id', 'pa_id', 'sup_id'
    ];


    public function supSuggestionsMaster()
    {
        return $this->belongsTo('App\Models\SupSuggestionsMaster', 'id');
    }
}
