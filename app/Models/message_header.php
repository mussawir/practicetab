<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class message_header extends Model
{
    protected $table = 'message_header';
    protected $primaryKey = 'id';

    protected $fillable = ['msg_date', 'patient_login_id', 'patient_id','practitioner_id','practitioner_login_id'];
}
