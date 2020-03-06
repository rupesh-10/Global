<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
    Global Suppliers
  </title>
  <!-- Favicon -->
  <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet">

  <!-- Fonts -->
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet">
  <!-- Icons -->
  <link href="{{asset('nucleo/css/nucleo.css')}}" rel="stylesheet" />
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">

  <!-- CSS Files -->
  <link href="{{ asset('css/argon.css')}}" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet-search@2.3.7/dist/leaflet-search.src.css" />
  <link rel="stylesheet" type="text/css"
    href="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet-geocoder/0.0.1-beta.5/esri-leaflet-geocoder.css">
  <style>
    #mapSearchContainer {
      position: fixed;
      top: 20px;
      right: 40px;
      height: 30px;
      width: 180px;
      z-index: 110;
      font-size: 10pt;
      color: #5d5d5d;
      border: solid 1px #bbb;
      background-color: #f8f8f8;
    }

    .pointer {
      position: absolute;
      top: 86px;
      left: 60px;
      z-index: 99999;
    }
  </style>
</head>

<body class="">

  @include('admin/components/navbar')

  <div class="main-content p-2">
    @yield('content')
  </div>


</body>
@include('admin/components/scripts')
@yield('scripts')
@yield('map')

</html>