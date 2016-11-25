<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class message_history extends Model
{
    protected $table = 'message_history';
    protected $primaryKey = 'msg_his_id';

    protected $fillable = ['msg_id', 'message','serial','sent_by'];
}
