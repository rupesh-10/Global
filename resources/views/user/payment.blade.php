@extends('layouts.app')
@section('content')

<div class="main-content bg-default">
    <div class="header bg-orange py-7 py-lg-8">
        <div class="container">
            <div class="header-body text-center mb-7">
                <div class="row p-2 justify-content-center">
                    <div class="card col-md-6">
                        <div class="card-body">
                            <h3>Your Orders:</h3>
                            <table class="table">
                                <tr>
                                    <th>Item</th>
                                    <th>Medium</th>
                                    <th>Price</th>
                                </tr>
                                @foreach($sales as $sale)
                                <tr>
                                    <td>{{ $sale->item->name }}</td>
                                    <td>{{ $sale->medium->name }}</td>
                                    <td>{{ $sale->price }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <h4>Total: {{ $price }}</h4>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="separator separator-bottom separator-skew zindex-100">
            <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1"
                xmlns="http://www.w3.org/2000/svg">
                <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
    </div>
    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card bg-secondary shadow border-0 p-2">
                    <div class="card-header">
                        <h2>Choose Payment Option</h2>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="col-md-10 contact-left-content">
                            <div class="address-con">
                                <button class="btn btn-primary" id="khalti_payment">Pay with Khalti</button>

                            </div>
                            <div class="address-con my-4">
                                <form method="POST"
                                    action="{{ route('checkout.payment.esewa.process', $sale->sale_id)}}">
                                    @csrf
                                    <button class="btn btn-success" type="submit">
                                        Pay with eSewa
                                    </button>
                                </form>
                            </div>
                             <div class="address-con mb-4">
                                <button class="btn btn-secondary" id="stripe_payment">Pay with Stripe</button>

                            </div>
                            <div class="address-con mb-4">
                                <a class="btn btn-warning" href="/">Continue as Cash On Delivery</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>
<script>

    //Khalti Payment
    var config = {
            // replace the publicKey with yours
            "publicKey": "test_public_key_dc74e0fd57cb46cd93832aee0a390234",
            "productIdentity": "1234567890",
            "productName": "Dragon",
            "productUrl": "http://gameofthrones.wikia.com/wiki/Dragons",
            "paymentPreference": [
                "KHALTI",
                "EBANKING",
                "MOBILE_BANKING",
                "CONNECT_IPS",
                "SCT",
                ],
            "eventHandler": {
                onSuccess (payload) {
                    // hit merchant api for initiating verfication
                    console.log(payload);
                },
                onError (error) {
                    console.log(error);
                },
                onClose () {
                    console.log('widget is closing');
                }
            }
        };


      var checkout = new KhaltiCheckout(config);
      var btn = document.getElementById("khalti_payment");
      btn.onclick = function () {
          checkout.show({amount: {{ $price }}*100});
      }
</script>
@endsection
