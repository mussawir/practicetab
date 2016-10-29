<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuggestionsSearch extends Model
{
    // explicitly define table and primary key
    protected $table = 'suggestion_search';
    protected $primaryKey = 'id';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'master_id', 'pra_id', 'pra_fullname', 'message', 'pa_ids', 'sup_ids', 'nut_ids',
        'created_at', 'sug_type'
    ];


    public function supSuggestionsMaster()
    {
        return $this->belongsTo('App\Models\SupSuggestionsMaster', 'id');
    }
}
