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

    public function about(){
        return view('user.about');
    }
    
    public function contact(){
        return view('user.contactus');
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
        if($place==null){
            abort('404');   
        }
        // dd($place);
        $items = Item::all();
    	$mediums = Medium::all();
        $amount = Amount::where('place_id',$place_id)->get();
        $amount = $amount->groupBy('item_id');
        $epay_url = "https://uat.esewa.com.np/epay/main";
        $pid = "GS1";
        $successurl = "https://global.test/esewa/success";
        $failedurl = "https://global.test/esewa/failed"; 
        $temp=$amount;
        $amount=[];
        foreach ($temp as $k => $item) {
            $amount[$k] = [];
            foreach ($item as $key => $media) {
                $amount[$k][$media->medium_id]['price'] = $media->price;
            }
        }
        return view('user.checkout',compact('items','mediums','amount','place','pid','successurl','failedurl'));
       
    }
    public function order(Request $request){
        $data = request()->validate([
            'name' => 'required',
            'items'=>'required',
            'mediums'=>'required',
            'number'=>'required',
            'address' =>'required',
            'quantities' =>'required|min:1',
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
        //  $client = request()->get('name');
        //  $api_url = "http://api.sparrowsms.com/v2/sms/?";
        //   http_build_query(array(
        //       'token' => '<token provided>',
        //       'from' => 'Global Suppliers',
        //       'to' => request()->get('number'),
        //       'text' => "Dear $client your Order has been Successfully noted, Our employee will shortly call you",
        //   ));
        //   $response = file_get_contents($api_url);
         return redirect('/checkout/payment/'.$sale->id)->with("success",'Thank you for Order! Please Choose Your Payment Method.');
        

    }
    
    public function payment($order){
        $sales = SaleItem::where('sale_id',$order)->get();
        $price = 0;
        foreach($sales as $sale){
            $price += $sale->price;
        }
        return view('user.payment',compact('sales','order','price'));
        
    }

    public function getPrice(Request $request){

        $price = Amount::where('place_id',$request->get('place'))->where('medium_id',$request->get('medium'))->where('item_id',$request->get('item'))->first();
        return response()->json($price, 200);
    }

    public function userInfo(){
        $user_id =auth()->user()->id;
        $user = User::findorFail($user_id);
        if(auth()->user()->is_admin==1){
            abort('404');
        }
        $orders = Sale::where('user_id',$user_id)->with('saleItem')->get();
        // dd($orders);
        return view('user.info',compact('orders','user'));
    }
    
    public function userEdit(){
         $user_id =auth()->user()->id;
         $user = User::findorFail($user_id);
        if(auth()->user()->is_admin==1){
            abort('404');
        }
        return view('user.edit',compact('user'));
    }
    public function userUpdate(){
        request()->validate([
            'name'=> 'required',
            'email' => 'required',
            'phone_number'=> 'required',
        ]);
        $user_id =auth()->user()->id;
        $user = User::findorFail($user_id);
        $user->name = request()->get('name');
        $user->email = request()->get('email');
        $user->phone_number = request()->get('phone_number');
        $user->save();
        return redirect("/user/info")->with("success","Profile updated Successfully");
    }

    public function guestOrder(){
        request()->validate([
            'phone_number' => 'required',
        ]);
        $phone_number = request()->get('phone_number');
        $orders = Sale::where('is_guest',1)->where('phone_number',$phone_number)->get();
        return view('user.guest_order',compact('orders'));
    }

    public function esewaSuccess(Request $request){
        $url = "https://uat.esewa.com.np/epay/transrec";
        $ref = request()->get('refId');
        $data = [
            'amt' =>1000, 
            'rid' =>$ref,
            'pid' =>'GS1',
            'scd' =>'epay_payment',
        ];

        $curl = curl_init($url);
        $curl_setopt($curl, CURLOPT_POST , true);
        $curl_setopt($curl, CURLOPT_POSTFIELDS , $data);
        $curl_setopt($curl, CURLOPT_RETURNTRANSFER , true);
        $response = curl_exec($curl);
        if($response== "success"){
        return view("esewa.success");
        }
        else{
            return view("esewa.failed");
        }
        curl_close($curl);

    }
    
    public function esewaFailed(){
        return view("esewa.failed");
    }
    public function checkOrder(){
        return view('user/order');
    }
}
