<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupSuggestionsSearch extends Model
{
    // explicitly define table and primary key
    protected $table = 'sup_sugest_search';
    protected $primaryKey = 'id';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'master_id', 'pra_id', 'pra_fullname', 'message', 'pa_ids', 'sup_ids', 'created_at'
    ];


    public function supSuggestionsMaster()
    {
        return $this->belongsTo('App\Models\SupSuggestionsMaster', 'id');
    }
}
