<?php

namespace App\services;
use App\Amount;


class PlacePriceGetter
{
    public function get($place_id){
        $amounts = Amount::where('place_id',$place_id)->get();
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
        return $amounts;

    }
}
