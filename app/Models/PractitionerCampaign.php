<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PractitionerCampaign extends Model
{
    // explicitly define table and primary key
    protected $table = 'practitioner_campaign';
    protected $primaryKey = 'cam_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'campaign_name', 'start_data', 'end_date', 'sent_to', 'group_name', 'message', 'status', 'user_id'
    ];

    public function userId()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
