<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PractitionerEmail extends Model
{
    // explicitly define table and primary key
    protected $table = 'practitioner_emails';
    protected $primaryKey = 'pe_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pra_id',
        'sent_to',
        'subject',
        'message',
        'attachment'
    ];

    public function practitioner()
    {
        return $this->belongsTo('App\Models\Practitioner', 'pra_id');
    }
}
