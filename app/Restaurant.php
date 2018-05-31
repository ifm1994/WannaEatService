<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $table = 'restaurants';

    protected $fillable = [
        'name',
        'address',
        'kind_of_food',
        'rating',
        'image_path',
        'opening_hours',
        'description',
        'phone',
        'latitude',
        'longitude',
        'capacity',
        'id_admin',
    ];
}
