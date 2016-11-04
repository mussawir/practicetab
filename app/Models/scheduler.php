<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class scheduler extends Model
{
    protected $table = 'scheduler';
    protected $primaryKey = 'id';

    protected $fillable = ['patient_id', 'timeIn', 'timeOut', 'app_date','reason','pDate',
        'pTime','pDuration','pstatus','app_desc'];


}
