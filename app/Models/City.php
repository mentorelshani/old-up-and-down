<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';

    public function addresses(){
         return $this->hasMany('App\Models\Address','city_id');
    }
}
