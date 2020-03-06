<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\SaleItem;
use App\Sale;
use App\Http\Controllers\Controller;

class SalesController extends Controller
{
    public function store(){
        //
    }

    public function order(){
          $orders = Sale::with('saleItem')->get();
        //   dd($carts);
        return view('admin.sales.order',compact('orders'));
    }


    public function delivery(){
        $orders = Sale::with('saleItem')->where('is_started',1)->get();
        return view('admin.sales.delivery',compact('orders'));
    }

    public function deliveryStart($id){
        $delivery = Sale::find($id);
        $delivery->is_started = 1;
        $delivery->save();
        return redirect()->back()->with('success',"Delivery Started Succesfully");
    }

    public function deliveryUpdate($id){
        $delivery = Sale::find($id);
        $delivery->is_delivered = 1;
        $delivery->save();
        return redirect()->back()->with("success","Delivered");
    }

    public function sales(){
           $orders = Sale::with('saleItem')->where('is_delivered',1)->get();
        return view('admin.sales.sales',compact('orders'));
    }
    public function addToCart(){
        dd(request());
    }
}