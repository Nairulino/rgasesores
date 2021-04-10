<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sociedade extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'cif', 'phone', 'email', 'user_name', 'id_user'
    ];
}
