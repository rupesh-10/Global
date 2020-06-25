<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{

    const PAYMENT_COMPLETED = 1;
    const PAYMENT_PENDING = 0;

    public function saleItem(){
    	return $this->hasMany(SaleItem::class);
    }
    public function user(){
    	return $this->belongsTO(User::class);
    }
}

