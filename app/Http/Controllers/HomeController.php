<?php

namespace App\Http\Controllers;
use App\Item;
use App\Medium;
use App\Amount;
use App\Place;
use App\SaleItem;
use App\Sale;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
    	$items = Item::all();
    	$mediums = Medium::all();
    	$amounts = Amount::all();
        $places = Place::all();

        $amounts = $amounts->groupBy('item_id');
        $temp=$amounts;
        $amounts=[];
        foreach ($temp as $k => $item) {
            $amounts[$k] = [];
            foreach ($item as $key => $media) {
                $amounts[$k][$media->medium_id]['price'] = $media->price;
            }
        }
        // dd($amounts);

        return view('user.index',compact('items','mediums','amounts','places'));
    }


    public function getPlaces()
    {
        $places = Place::all();

        return response()->json($places, 200);
    }


    public function getPlace($id)
    {
        $place = Place::where('id',$id)->with('amounts')->get();
        return response()->json($place, 200);
    }
    public function checkout(Request $request){
        // dd($request->all());
        $place_id=$request->get('selectedPlace');
        $place = Place::where('id',$place_id)->first();
        // dd($place);
        $items = Item::all();
    	$mediums = Medium::all();
        $amount = Amount::where('place_id',$place_id)->get();
        $amount = $amount->groupBy('item_id');
        
        $temp=$amount;
        $amount=[];
        foreach ($temp as $k => $item) {
            $amount[$k] = [];
            foreach ($item as $key => $media) {
                $amount[$k][$media->medium_id]['price'] = $media->price;
            }
        }
        return view('user.checkout',compact('items','mediums','amount','place'));
       
    }
    public function order(Request $request){
        $data = request()->validate([
            'name' => 'required',
            'items'=>'required|not_in:0',
            'mediums'=>'required|not_in:0',
            'number'=>'required',
            'address' =>'required',
            'quantities.*' =>'required',
        ]);
        $sale = new Sale;
        if(Auth::check()){
            $sale->user_id = auth()->user()->id; 
            $sale->is_guest = 0;
        }

        else{
            $sale->is_guest = 1;
        }

         $sale->is_finalized = request()->get('is_finalize');
         $sale->is_started = 0;
         $sale->is_delivered = 0;
         $sale->client_name = request()->get('name');
         $sale->address = request()->get('address');
         $sale->phone_number = request()->get('number');
         $sale->save();
         $items = request()->get('items');
         $mediums = request()->get('mediums');
         $quantities = request()->get('quantities');
         $prices = request()->get('prices');
          
         foreach($items as $ind=>$item){
             $saleItem = new SaleItem;
             $saleItem->item_id = $item;
             $saleItem->medium_id = $mediums[$ind];
             $saleItem->quantity = $quantities[$ind];
             $saleItem->price = $prices[$ind];
            $saleItem->sale_id = $sale->id;
             $saleItem->save();
         }
         
         
         return redirect('/')->with("success",'Your Order is successfull');
        

    }
    public function getPrice(Request $request){

        $price = Amount::where('place_id',$request->get('place'))->where('medium_id',$request->get('medium'))->where('item_id',$request->get('item'))->first();
        return response()->json($price, 200);
    }

    public function userOrder($id){
        $user = User::findorFail($id);
        $orders = Sale::where('user_id',$id)->with('saleItem')->get();
        // dd($orders);
        return view('user.order',compact('orders'));
    }

   
}
