<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    {{-- OwlCarousel --}}

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet-search@2.3.7/dist/leaflet-search.src.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet-geocoder/0.0.1-beta.5/esri-leaflet-geocoder.css">



    <title>Document</title>
</head>

<body>
    <style>
        .dataTables_length label,
        .dataTables_filter label {
            color: black;
        }
      
        #mapid {
            width: 100%;
            height:91vh;
        }

        #mapSearchContainer {
            position: fixed;
            top: 89px;
            right: 40px;
            height: 30px;
            width: 180px;
            z-index: 2000;
            font-size: 10pt;
            color: #5d5d5d;
            border: solid 1px #bbb;
            background-color: #f8f8f8;
        }
    </style>
    <nav class="navbar navbar-expand-md navbar-dark bg-primary shadow-sm">
        <div class="col-3 offset-1">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="fa fa-globe text-danger" style="font-size:28px;"></i>
                <strong> Global Suppliers</strong>
            </a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Contact us</a>
                </li>
                <!-- Authentication Links -->
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="modal" data-target="#guestModal">Track Order</a>
                </li>
                @endif
                @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                      
                    <a class="dropdown-item" href="/user/profile/{{ Auth::user()->id }}">My Profile</a>
                    <a class="dropdown-item" href="/user/orders/{{ Auth::user()->id }}">My Orders</a>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
        </div>
    </nav>
    <div class="modal" tabindex="-1" role="dialog" id="guestModal">
        <div class="modal-dialog" role="document">
        <form action="/guest/order">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title">Track Your Order</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

       <div class="modal-body">
              <label>Phone Number</label>
              <input type="text" name="phone_number" class="form-control">
        </div>
            <div class="modal-footer">
              <button class="btn btn-primary">Track</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
         </form>

        </div>
      </div>
    <div id="app">
        @yield('content')
    </div>
</body>
<script src="{{ asset('js/map.js') }}"></script>
<script src="{{asset('js/app.js')}}"></script>
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
<script src="https://khalti.com/static/khalti-checkout.js"></script>
<script src="https://unpkg.com/leaflet-search@2.3.7/dist/leaflet-search.src.js"></script>
<script src="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet/0.0.1-beta.5/esri-leaflet.js"></script>
<script src="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet-geocoder/0.0.1-beta.5/esri-leaflet-geocoder.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    $(document).ready(function() {
      toastr.options = {
          "positionClass" : "toast-top-center",
          "closeButton" : true,
          "debug" : false,
          "newestOnTop" : true,
          "progressBar" : true,
          "preventDuplicates" : false,
          "onclick" : null,
          "showDuration" : "300",
          "hideDuration" : "1000",
          "timeOut" : "5000",
          "extendedTimeOut" : "1000",
          "showEasing" : "swing",
          "hideEasing" : "linear",
          "showMethod" : "fadeIn",
          "hideMethod" : "fadeOut"
      }

      @if(Session::has('success'))
          toastr['success']("{{ Session::get('success') }}")
      @endif
          @if(Session::has('warning'))
          toastr['warning']("{{ Session::get('warning') }}")
      @endif
          @if(Session::has('error'))
          toastr['error']("{{ Session::get('error') }}")
      @endif
  });
 $(document).ready(function() {
    $('#dataTable').DataTable();

});
</script>
@yield('scripts')

</html>