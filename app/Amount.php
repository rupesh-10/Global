<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Amount extends Model
{
    public function item()
    {
       return $this->belongsTo(Item::class);
    }
    public function medium()
    {
        return $this->belongsTo(Medium::class);
    }
    public function place(){
        return $this->belongsTo(Place::class);
    }
}
