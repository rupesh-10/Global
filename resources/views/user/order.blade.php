@extends('layouts.app')
@section('content')
    <div class="row m-0 pt-4">
        <div class="col-md-7">
            <h3>Your Orders</h3>
            <table class="table text-center">
               <tr>
                   <th>Items</th>
                   <th>Medium</th>
                   <th>Quantity</th>
                   <th>Price</th>
               </tr>
               <tr>
                   <td></td>
                   <td></td>
                   <td></td>
                   <td></td>
               </tr>
            </table>
  
        </div>

      <div class="col-md-4">
            <div>
                <h3>Choose Payment Option</h3>
            </div>

        <div class="d-block">
            <div class="p-2">
                <input type="radio" value="cod" id="cod" name="payment"> <label for="cod"> Cash On Delivery</label>
            </div>
            <div class="p-2">
                <input type="radio" value="esewa" id="esewa" name="payment"> <label for="esewa" class="btn btn-success"> Pay with Esewa</label>
            </div>
            <div class="p-2">
                <input type="radio" value="khalti" id="khalti" name="payment"> <label for="khalti" class="btn text-white" style="background-color:#773292;"> Pay with Khalti</label>
            </div>

        </div>
      </div>

    
    </div>
    <div class="text-center mt-5">
        <button class="btn btn-success">Order Now</button>
    </div>
@endsection