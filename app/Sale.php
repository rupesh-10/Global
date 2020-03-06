<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    public function saleItem(){
    	return $this->hasMany(SaleItem::class);
    }
    public function user(){
    	return $this->belongsTO(User::class);
    }
}

