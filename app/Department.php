<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public function profiles()
    {
        return $this->hasMany('App\Profile');
    }

    public function users()
    {
        return $this->hasMany('App\User');
    }
}
