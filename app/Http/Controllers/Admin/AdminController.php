<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Sale;


class AdminController extends Controller
{
    public function dashboard(){
        $sales= Sale::where('is_delivered',1)->get();
        $deliveries = Sale::where('is_delivered',0)->get();
        $users = User::where('is_admin',0)->get();
        return view('admin.dashboard',compact('sales','users','deliveries'));
    }
}
