<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminUser extends Model
{


    //Tabla a la que va user el modelo User
    protected $table = 'admin_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'ftoken', 'hasRestaurant',
    ];
}
