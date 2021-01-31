<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = ['user_id', 'name', 'mimetype', 'url', 'thumbnail'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
