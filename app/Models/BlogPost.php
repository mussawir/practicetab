<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class BlogPost extends Authenticatable
{
    // explicitly define table and primary key
    protected $table = 'blog_posts';
    protected $primaryKey = 'post_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_id',
        'pra_id',
        'heading',
        'contents',
           ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

}
