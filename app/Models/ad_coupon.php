<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ad_coupon extends Model
{
    protected $table = 'ad_coupon';
    protected $primaryKey = 'cId';

    protected $fillable = ['cId', 'cCode', 'expiryDate', 'status','cDescription','generatedBy','cTitle','cFile','discount','discountType'];

}
