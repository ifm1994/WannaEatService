<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';

    protected $fillable = [
        'id_restaurant',
        'id_user',
        'time',
        'price',
        'id_transaction',
        'products_and_amount',
        'payment_method',
        'client_name',
        'client_phone',
        'client_email',
        'number_of_commensals',
        'client_commentary',
        'canrate',
        'status',
    ];
}
