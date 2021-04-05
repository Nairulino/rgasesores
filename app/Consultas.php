<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consultas extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content', 'title','id_user','read','answered', 'files', 'id_response'
    ];
}
