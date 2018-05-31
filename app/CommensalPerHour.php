<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommensalPerHour extends Model
{
    protected $table = 'commensals_capacity_per_hour';

    protected $fillable = [
        'id_restaurant',
        'hour',
        'commensal_capacity',
    ];
}
