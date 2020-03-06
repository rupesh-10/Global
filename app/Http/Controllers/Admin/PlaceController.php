<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\PlacePriceGetter;
use Illuminate\Http\Request;
use App\Place;
use App\Item;
use App\Medium;
use App\Amount; 

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $items = Item::all();
       $mediums = Medium::all();
       $places = Place::all();
       return view('admin.places.index',compact('places','items','mediums'));
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
         dd(request());
            }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,PlacePriceGetter $placePriceGetter )
    {
        $place = Place::find($id);  
        $items = Item::all();
        $mediums = Medium::all();

        $amounts = $placePriceGetter->get($id);
        return view('admin.places.edit',compact('place','items','mediums','amounts'));
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
        // dd($request->all());
        $data = request()->validate([
            'place' => 'required',
            'latitude' =>'required',
            'longitude' =>'required',
        ]);
        $place = Place::find($id);
        $place->name = request()->get('place');
        $place->latitude = request()->get('latitude');
        $place->longitude = request()->get('longitude');
        $place->save();

        $itemsPrices = request()->get('prices');
        // dd($amounts);
        foreach($itemsPrices as $item=>$itemPrices){
            foreach($itemPrices as $medium=>$price ){
                $amount = Amount::where('place_id',$place->id)->where('item_id',$item)->where('medium_id',$medium)->first();
                if(!$amount) $amount = new Amount();
                $amount->item_id = $item;
                $amount->medium_id = $medium;
                $amount->price = $price;
                $amount->place_id = $place->id;
                $amount->is_perseptic = 0;
                $amount->save();
            }
        }
        return redirect('admin/places')->with('success','Places Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
