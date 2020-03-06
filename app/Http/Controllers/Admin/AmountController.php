<?php

namespace App\Http\Controllers\Admin;
use App\Amount;
use App\Item;
use App\Medium;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Place;

class AmountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $amounts = Amount::all();
        $items= Item::all();
        $mediums = Medium::all();
        return view('admin.amount.index',compact('amounts','items','mediums'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    
        $data = request()->validate([
            'place' => 'required|unique:places,name',
            'latitude' =>'required|unique:places,latitude',
            'longitude' =>'required|unique:places,longitude',
        ]);
        $place = new Place;
        $place->name = request()->get('place');
        $place->latitude = request()->get('latitude');
        $place->longitude = request()->get('longitude');
        $place->save();

        $itemsPrices = request()->get('prices');
        foreach($itemsPrices as $item=>$itemPrices){
            foreach($itemPrices as $medium=>$price ){
                $amount = new Amount;
                $amount->item_id = $item;
                $amount->medium_id = $medium;
                $amount->price = $price;
                $amount->place_id = $place->id;
                $amount->is_perseptic = 0;
                $amount->save();
            }
        }
        return redirect()->back()->with('success','Places Created Successfully');
    //  $amount = new Amount;
    //  $amount->item_id = request()->get('item');
    //  $amount->medium_id = request()->get('medium');
    //  $amount->price= request()->get('price');
    //  $amount->default_distance = request()->get('distance');
    //  $amount->per_km_price = request()->get('per_distance_price');
    //  $amount->save();
    //  return redirect('/admin/amount')->with('success',"Item Created Successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
           
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = request()->validate([
            'item' => 'required',
            'medium' =>'required',
            'price' =>'required',
        ]);

     $amount = Amount::find($id);
     $amount->item_id = request()->get('item');
     $amount->medium_id = request()->get('medium');
     $amount->price= request()->get('price');
     $amount->save();
    return redirect('admin/amount')->with('success',"Amount Updated Successfully");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $amount = Amount::find($id);
        $amount->delete();
        return redirect('/admin/amount')->with('success','Deleted Successfully');
    }
}
