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
    public function deliveryCancel($id){
        $delivery = Sale::find($id);
        $delivery->is_started = 0;
        $delivery->is_delivered =0;
        $delivery->save();
        return redirect()->back()->with('warning',"Delivery Cancelled");
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
   
    public function editOrder($id){
        $order = Sale::findorFail($id);
        $orderItems = SaleItem::where('sale_id',$id);
        return view('admin.sales.order_edit',compact('order','orderItems'));
    }
    
    public function updateOrder(Request $request, $id){
        
    }

    public function deleteOrder($id){
        $order = Sale::FindorFail($id);
        $order->delete();
        $orderItems = SaleItem::where('sale_id',$id)->get();
        foreach($orderItems as $orderItem){
            $orderItem->delete();
        }
        return redirect()->back()->with('success',"Order Deleted Succesfully");
    }
}