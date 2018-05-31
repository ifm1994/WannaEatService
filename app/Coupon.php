<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = 'coupons';

    protected $fillable = [
        'description',
        'id_restaurant',
        'id_user',
        'category',
        'discount',
        'code',
    ];
}
