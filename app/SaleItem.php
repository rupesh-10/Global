<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
     public function sale(){
    	return $this->belongsTo(Sale::class);
    }
    public function medium(){
    	return $this->belongsTo(Medium::class);
    }
    public function item(){
    	return $this->belongsTo(Item::class);
    }
}
