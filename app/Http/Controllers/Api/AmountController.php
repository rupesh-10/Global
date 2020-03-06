<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Amount;

class AmountController extends Controller
{
    public function index() {
    	$amounts = Amount::with(['item', 'medium'])->get(['price', 'item_id', 'medium_id', 'id']);

    	return response()->json($amounts);
    }
}
