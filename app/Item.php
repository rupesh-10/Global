<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
 public function amounts(){
 	return $this->hasMany(Amount::class);
 }
 public function saleItem(){
 	return $this->hasMany(SaleItem::class);
 }

}
