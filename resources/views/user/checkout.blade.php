@extends('layouts.app')
@section('content')
<form action="/checkout/order" method="post" id="form">
  @csrf
  <div class="container-fluid mt-2">
    <h1 class="font-weight-bold text-info text-center">Checkout</h1>
    <div class="row d-flex p-3">
      {{-- <div class="col-md-12 order-md-1 d-flex"> --}}


      {{-- Information Section --}}
      <input type="hidden" id="selectedPlace" value="{{ $place->id }}">

      {{-- Order Section --}}

      <div class="col-md-7 p-4" style=" overflow: auto; height:500px; " id="listOfOrders">
        <div class="row pb-3">
          <div class="col-md-9">
            <h2>Select Your Order</h2>
          </div>
          <div class="col-md-2   text-right">
            <a class="btn btn-danger text-white btn-rounded btn-sm" id="add"> + </a>
            <a class="btn btn-danger text-white btn-rounded btn-sm" id="sub"> - </a>
          </div>
        </div>
        <div class="row pb-3" id="select_order">
          <div class="col-lg-3">
            <div class="form-group">
              <label class="form-control-label">
                Item:
              </label>
              <select class="form-control items  @error('items') is-invalid @enderror " name="items[]" id="item_0">
                <option selected="true" disabled>Choose Item</option>
                @foreach($items as $item)
                <option value="{{ $item->id }}">{{  $item->name   }}</option>
                @endforeach
              </select>
              @error('items')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>
          <div class="col-lg-3">
            <div class="form-group">
              <label class="form-control-label">
                By:
              </label>
              <select class="form-control mediums @error('mediums') is-invalid @enderror" name="mediums[]" id="medium_0"
                style="width:100%;">
                <option selected='true' disabled>Choose Medium</option>
                @foreach($mediums as $medium)
                <option value="{{ $medium->id }}">{{ $medium->name }}</option>
                @endforeach
              </select>
              @error('mediums')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>
          <div class="col-lg-3">
            <div class="form-group">
              <label class="form-control-label">
                Qty:
              </label>
              <input type="number" class="form-control quantities p-2" name="quantities[]" value="1" min="1" max="25"
                id="quantity_0">
            </div>
          </div>
          <div class="col-lg-3">
            <div class="form-group">
              <label class="form-control-label">
                Price(Rs.):
              </label>
              <input type="text" readonly name='prices[]' id="price_0" class="form-control prices value=" 0">
            </div>
          </div>
          <hr class="col-md-11">
        </div>
      </div>

      <div class="col-md-5 p-3" style="height:500px;">
        <div class="row">
          <div class="col-md-12 mb-3">
            <label for="name">Full name</label>
            <input id="name" type="text" value="@guest @else{{ auth()->user()->name }}@endguest"
              class="form-control @error('name') is-invalid @enderror" name="name" autocomplete="off" autofocus>
            @error('name')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="p_number">Phone N.</label>
            <input id="number" value="@guest @else{{ auth()->user()->phone_number }}@endguest" type="text"
              class="form-control @error('number') is-invalid @enderror" name="number" autocomplete="off" autofocus>
            @error('number')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror

          </div>
          <div class="col-md-5 mb-3">
            <label for="address">Address</label>
            <input type="text" readonly class="form-control  @error('address') is-invalid @enderror" id="address"
              value="{{ $place->name }}" name="address">
            @error('address')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror

          </div>

        </div>

        <hr class="mb-4">
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="save-info">
          <label class="custom-control-label" for="save-info">Save this information for next time</label>
        </div>
        <hr class="mb-4">


        <hr class="mb-4">

      </div>
    </div>
    <input type="hidden" name="is_finalize" value=0 id="is_finalize">
  </div>
  <div class="text-center">
    <button class="btn btn-primary btn-rounded">Continue to Payment</button>
  </div>
</form>
{{-- <div class="custom-control mb-3">
  <form action="https://uat.esewa.com.np/epay/main" method="POST" id="payWithEsewa">
    <input name="tAmt" type="hidden" id="tAmt">
    <input name="amt" type="hidden" id="amt">
    <input value="0" name="txAmt" type="hidden">
    <input value="0" name="psc" type="hidden">
    <input value="0" name="pdc" type="hidden">
    <input value="epay_payment" name="scd" type="hidden">
    <input value="{{ $pid }}" name="pid" type="hidden">
<input value="{{ $successurl }}" type="hidden" name="su">
<input value="{{ $failedurl }}" type="hidden" name="fu">
</form>
</div> --}}
@guest
<div class="modal" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog" role="document">`
    <div class="modal-content">

      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h2 class="text-danger text-center">Login, for easy order tracking and information</h2>
      </div>
      <div class="modal-footer">
        <a type="button" class="btn btn-primary" href="/login">Login</a>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Conitnue as Guest</button>
      </div>
    </div>
  </div>
</div>
@endguest
@section('scripts')

<script>
  $(document).ready(function(){
            $("#esewaButton").on('click',function(event){
              event.preventDefault();
              $('#amt').val(total_price);
              $('#tAmt').val(total_price);
              $("#payWithEsewa").submit();
             
            })
        }); 
</script>
<script>
  $(document).ready(function(){
            $("#myModal").modal('show');
        });
      $('#medium_checkbox').on('click',function(){

    if($(this).is(':checked')){
      $('#quantity').attr('disabled',false)
    }
    else{
      $('#quantity').attr('disabled',true)
    }
    }); 
    let indexOfOrders= 0;
    function createOrderColumn(){
      indexOfOrders++;
      // console.log(indexOfOrders)
      var selectOrder = 
   ` <div class="row" id="select_order">
                <div class="col-lg-3">
                <div class="form-group">
                <label class= 'form-control-label'><h5>Item: </h5> </label>
                <select class="form-control items" name="items[]" id="item_${indexOfOrders}">f
                <option selected="true" disabled>Choose Item</option>
                  @foreach($items as $item)
                <option value="{{ $item->id }}">{{  $item->name   }}</option>
                @endforeach
                </select>
                </div>
                </div>
                <div class="col-lg-3">
                <div class="form-group">
                <label class= "form-control-label"> <h5> By: </h5> </label>
                <select class="form-control mediums" name= "mediums[]" id="medium_${indexOfOrders}">
                <option selected="true" disabled>Choose Medium</option>
                @foreach($mediums as $medium)
              <option value="{{ $medium->id }}">{{ $medium->name }}</option>
                @endforeach
                </select> 
                </div>
                </div>
                <div class="col-lg-3">
                <div class="form-group">
                <label class= 'form-control-label'> <h5> Qty: </h5> </label>
                <input type="number" class="form-control quantities p-2 " name="quantities[]" id="quantity_${indexOfOrders}" min="1" max="25" value="1">
                </div>
                </div>
                <div class="col-lg-3">
                <div class="form-group">
                <label class= 'form-control-label'>
                  <h5>
                  Price(Rs.):
                  </h5> 
                </label>
                  <input type="text" readonly name='prices[]' id="price_${indexOfOrders}" class="form-control prices" value="0">
                  </div>
              </div>
              <hr class="col-md-11">

              </div>`

    
      return selectOrder;
    }
    $('#add').on('click',function(){
      // $(createOrderColumn()).append('#select_order');

      $("#listOfOrders").append($(createOrderColumn()))
    })

    $('#sub').on('click',sub)
    function sub(){
      let d = $('[id="select_order"]');
      if(d.length >1) { d[d.length-1].remove();indexOfOrders--};
    }



    $(document).on("change",".items",Change)
    $(document).on("change",".mediums",Change)  
    $(document).on('change',".quantities",Change)
    var total_price = 0;
    selectedItemMedium=[];

function Change(){
      let medium = $('#medium_'+indexOfOrders).val();
      let index = ($('#medium_'+indexOfOrders)[0].id).split("_")[1];
      let item = $('#item_'+index).val();
      let quantity = $('#quantity_'+index).val();
      let place_id = $('#selectedPlace').val();
      getPrice(medium,item,index,quantity,place_id)
      let medium_total = $('.mediums').map(function(){return $(this).val();}).get();
      let item_total = $('.items').map(function(){return $(this).val();}).get();
      console.log(selectedItemMedium)
      let result = selectedItemMedium.includes((item.toString()+medium.toString()))
      for(var i=0; i<=item_total.length-1;i++){
        selectedItem= item_total[i].toString();
        selectedMedium = medium_total[i].toString();
        selectedItemMedium[i] = selectedItem + selectedMedium;
      }
  
      if(result){
        sub();
      }
        
}

function getPrice(medium,item,index,quantity,place_id){
  axios.get('https://global.test/getPrice',{params:{item:item,medium:medium,place:place_id}})
		.then(function (response) {
      let price = response.data.price;
      $('#price_'+index).val((parseFloat(price)*quantity)||'0');
        total_price+=parseInt($('#price_'+index).val());      
    })
}
    
  

//Khalti Payment
   var config = {
          
            "publicKey": "test_public_key_47afe119e7b5446c82b17ecdcc5549ad",
            "productIdentity": "1234567890",
            "productName": "Dragon",
            "productUrl": "http://gameofthrones.wikia.com/wiki/Dragons",
            "eventHandler": {
                onSuccess (payload) {
                    // hit merchant api for initiating verfication
                    $('#is_finalize').val(1); 
                    alert('Success')
                    console.log(payload)
                },
                onError (error) {
                    alert("Error")
                },
                onClose () {
                   
                }
            }
        };
        
        
        var checkout = new KhaltiCheckout(config);
        var btn = document.getElementById("khalti_payment");
        btn.onclick = function () {
            checkout.show({amount: total_price*100});
        }
</script>

@endsection
@endsection