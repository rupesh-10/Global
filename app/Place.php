<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    public function amounts()
    {
        return $this->hasMany(Amount::class);
    }
}
