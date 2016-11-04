<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class PracticeProfile extends Authenticatable
{
    // explicitly define table and primary key
    protected $table = 'practice_profile';
    protected $primaryKey = 'practice_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable =[
        'practice_id',
'pra_id',
'website_url',
'about',
'practice_years',
'degree',
'accepts_new_patients',
'ai_woc',
'ai_pi',
'ai_ppo',
'ai_hmo',
'ai_medicaid',
'ai_medicare',
'languages_spoken',
'specialties'

    ];

}
