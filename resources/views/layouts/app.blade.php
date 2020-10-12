<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    {{-- OwlCarousel --}}
    <link href="{{asset('nucleo/css/nucleo.css')}}" rel="stylesheet" />
    <!-- CSS Files -->
    <link href="{{ asset('css/argon.css')}}" rel="stylesheet" />
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet-search@2.3.7/dist/leaflet-search.src.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet-geocoder/0.0.1-beta.5/esri-leaflet-geocoder.css">


    @yield('styles')
    <title>Global Suppliers</title>
</head>

<body>
    <style>
        .dataTables_length label,
        .dataTables_filter label {
            color: black;
        }

        #mapid {
            width: 100%;
            height: 91vh;
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

        .title {
            color: #353434;
            font-size: 3em;
            text-align: left;
            letter-spacing: 1px;
            font-weight: 400;
            font-family: 'Inconsolata', monospace;

        }

        a.carousel-control-next.test,
        a.carousel-control-prev.test {
            color: #0e0f10;
            text-align: center;
            opacity: 0.9;
            font-size: 2em;
        }
    </style>
    <nav class="navbar navbar-expand-md navbar-dark bg-orange shadow-sm">
        <div class="col-3 offset-1">
            <a class="navbar-brand d-flex" href="{{ url('/') }}">
                <i class="ni ni-world text-primary mr-2" style="font-size:28px;"></i>
                <strong> Global Suppliers</strong>
            </a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav ml-auto">
                <li class="text-right">
                    <button type="button" class="navbar-toggler" data-toggle="collapse"
                        data-target="#navbarSupportedContent" style="outline:none;">
                        <span></span>
                        <span></span>
                    </button>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/about">About Us</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/contact">Contact us</a>
                </li>
                <!-- Authentication Links -->
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}"> Login</a>
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

                        <a class="dropdown-item" href="/user/info">My Info</a>
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
                        <input type="text" name="phone_number" class="form-control" placeholder="Your Phone Number">
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary">Track</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <div id="main-content">
        @yield('content')
    </div>
        <div class="row align-items-center m-0 footer">
            <div class="col-md-6">
                <div class="copyright text-center text-xl-left text-muted">
                    &copy; 2020 <a href="https://www.alphatech.com.np" class="font-weight-bold ml-1"
                        target="_blank">Alpha Tech</a>
                </div>
            </div>
            <div class="col-md-6">
                <ul class="nav nav-footer justify-content-center justify-content-xl-end">
                    <li class="nav-item">
                        <a href="/" class="nav-link" target="_blank">Global Suppliers</a>
                    </li>
                    <li class="nav-item">
                        <a href="/about" class="nav-link" target="_blank">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="/contact" class="nav-link" target="_blank">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="/privacy" class="nav-link" target="_blank">Privacy and Policy</a>
                    </li>
                </ul>
            </div>
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