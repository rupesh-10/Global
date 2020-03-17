@extends('layouts.default')

@section('content')

<div class="col-12">
  <div id="accordion">
    <div class="col-md-12">
      <div class="card shadow">
        <div class="card-header bg-transparent border-0 p-0">

          <button class="btn btn-link collapsed text-dark" data-toggle="collapse" data-target="#collapseOne"
            aria-expanded="true" aria-controls="collapseOne">
            <h3> <strong>Add New Place</strong> </h3>
          </button>

        </div>
      </div>
      <div id="collapseOne" class="collapse bg-white show {{ $errors->count() ? 'show': '' }}" aria-labelledby="headingOne"
        data-parent="#accordion">
        <div class="card-body mt-2">
          <form method="post" action="{{ action('Admin\AmountController@store') }}">
            @csrf
            <div class="row">
              <div class="col-md-4 mb-3">
                <label for="place" class="text-md-left ">{{ __('Place Name') }}</label>
                <input id="place" type="text" class="form-control @error('place') is-invalid @enderror" name="place"
                  autocomplete="off" autofocus>

                @error('place')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="col-md-4 mb-3">
                <label for="latitude" class="text-md-left ">{{ __('Latitude') }}</label>
                <input id="latitude" type="text" class="form-control @error('latitude') is-invalid @enderror"
                  name="latitude" autocomplete="off" autofocus>

                @error('latitude')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="col-md-4 mb-3">
                <label for="longitude" class="text-md-left ">{{ __('Longitude') }}</label>

                <input id="longitude" type="text" class="form-control @error('longitude') is-invalid @enderror"
                  name="longitude" autocomplete="off" autofocus>

                @error('longitude')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 d-flex">
                <div class="col-md-6 mb-3">
                  <label class=" text-md-left ">{{ __('Coordinates') }}</label>

                  <div class="mapContainer" style="width:100%;">
                    <div id="mapId" style="height: 400px; width:100%; overflow: hidden;"></div>
                  </div>
                </div>
                <div id="tabs" class="project-tab col-md-6 ml-auto mt-4"
                  style="background-color:#fafafa; border-radius: 20px; height: 90%; ">
                  <div class="container">
                    <input type="hidden" id="distance">
                    <div class="row ">
                      <div class="col-md-12">
                        <nav>
                          <div class="nav nav-tabs nav-fill p-2" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active btn btn-primary mr-2" id="nav-home-tab" data-toggle="tab"
                              href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Per Medium</a>
                            <a class="nav-item nav-link btn btn-success" id="nav-profile-tab" data-toggle="tab"
                              href="#nav-profile" role="tab" aria-controls="nav-profile"
                              aria-selected="false">Perseptic</a>
                          </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                          <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                            aria-labelledby="nav-home-tab">
                            <table class="table" cellspacing="0">
                              <form action="{{ action('Admin\AmountController@store') }}" method="put">
                                @csrf
                                <thead>
                                  <tr>
                                    <th>BY:</th>
                                    @foreach($mediums as $medium)
                                    <th class="text-center">{{ $medium->name }}</th>
                                    @endforeach
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach($items as $item)
                                  <tr>
                                    <td>{{ $item->name }}</td>
                                    @foreach($mediums as $ind=>$medium)
                                    <td><input class="form-control" name="prices[{{ $item->id }}][{{ $medium->id }}]">
                                    </td>
                                    @endforeach
                                  </tr>
                                  @endforeach
                                </tbody>
                              </form>
                            </table>
                          </div>
                          <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <table class="table text-center" cellspacing="0">
                              <thead>
                                <tr>
                                  <th>Item</th>
                                  <th>Price</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($items as $item)
                                <tr>
                                  <td>{{ $item->name }}</td>
                                  <td style="width:50%"> <input type="text" name="perseptic" class="form-control"> </td>
                                </tr>
                                @endforeach
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group text-center">
              <button class="btn btn-success">Add New Place</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-12 mt-3">
      <div class="card shadow">
        <div class="card-header  border-0">
          <h3 class="text-warning mb-0">All Places : {{ $places->count() }}</h3>
        </div>
        <div class="table-responsive">
          <table class="table bg-white align-items-center table-flush">
            <thead class="">
              <tr>
                <th>S.N</th>
                <th>Place</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th width="150">Manage</th>
              </tr>
            </thead>
            <tbody>
              @foreach($places as $key=>$place)
              <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $place->name }}</td>
                <td>{{ $place->latitude }}</td>
                <td>{{ $place->longitude }}</td>
                <td>
                  <form method="post" action="{{ action('Admin\PlaceController@destroy', $place->id) }}">
                    @csrf
                    @method('DELETE')
                    <a class="btn btn-sm btn-secondary" href="{{ action('Admin\PlaceController@edit', $place->id) }}">
                      <i class="fa fa-edit"></i>
                    </a>
                    <button class="btn btn-danger btn-sm">
                      <i class="fa fa-trash"></i>
                    </button>
                    <a class="btn btn-info btn-sm view text-white" data-toggle="modal" data-target="#exampleModalLong"
                      data-id="{{ $place->id }}">
                      <i class="fa fa-eye"></i>
                    </a>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <div class="col-md-3">
            <div class="tab-content" id="nav-tabContent">
              <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

              </div>
              <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <table class="table" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Item</th>
                      <th>Price</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($items as $item)
                    <tr>
                      <td>{{ $item->name }}</td>
                      <td> {{ $item->perseptic }} </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title placeName" id="exampleModalLongTitle"></h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table" cellspacing="0">

          <thead>
            <tr>
              <th>BY:</th>
              @foreach($mediums as $medium)
              <th>{{ $medium->name }}</th>
              @endforeach
            </tr>
          </thead>
          <tbody>
            @foreach($items as $item)
            <tr>
              <td>{{ $item->name }}</td>
              @foreach($mediums as $ind=>$medium)
              <td>
                Rs.
                <span class="price" date-id="{{ [$item->id][$medium->id]['price'] ?? '-' }}"
                  id="price_{{ $item->id }}_{{ $medium->id }}">
                </span>
              </td>
              @endforeach
            </tr>
            @endforeach
          </tbody>

        </table>
      </div>
    </div>
  </div>
</div>

@endsection
@section('scripts')
<script>
  var mymap = L.map('mapId').setView([27.4368, 85.0026], 12);
  L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'pk.eyJ1IjoicnVwZXNoLTEwIiwiYSI6ImNrNnN3cW9najBqcDUza3F2ZDQ1ZjZ3dHcifQ.giIibmkus1-JZa4P5K4Y_Q'
}).addTo(mymap);
   var markerOptions = {
        title: "MyLocation",
        clickable: true,
        draggable: true
    }
    //get amount of place
    function getAmountsForPlace(place_id) {
	axios.get('https://global.test/getPlace/' + place_id).then(function (response) {
		let data = response.data[0];
	  let name = data['name']
		let amounts = data['amounts']
		$(".price").text("-")
  amounts.forEach(e => {
      console.log(e)
			let item_id = e['item_id']
			let medium_id = e['medium_id']
			let price = e['price'] || "-"
			$(`#price_${item_id}_${medium_id}`).text(parseInt(price)||'-')
      $('.placeName').text(name);
		})
	})
} 
$('.view').on('click',function(){
  let place_id = $(this).data('id')
  getAmountsForPlace(place_id);
})
//get latitude and longitude
    function getLatLng(e) {
       $('#longitude').val(this.getLatLng().lng);
       $('#latitude').val(this.getLatLng().lat)
       $('#place').val(e);
    }
  var dragMarker;
    L.control.scale().addTo(mymap);
      var searchControl = new L.esri.Controls.Geosearch().addTo(mymap);

        var results = new L.LayerGroup().addTo(mymap);

        searchControl.on('results', function(data){
          results.clearLayers();
          for (var i = data.results.length - 1; i >= 0; i--) {

            $('#place').val(data.results[i].name)
            $('#longitude').val(data.results[i].latlng.lng)
            $('#latitude').val(data.results[i].latlng.lat)

            dragMarker = results.addLayer(L.marker(data.results[i].latlng,{
              draggable:true
            }).addTo(mymap).bindPopup("your search").openPopup().on('dragend',getLatLng))

            findNearestPlace(data.results[i].latlng.lat,data.results[i].latlng.lng)
          }
      })

setTimeout(function(){$('.pointer').fadeOut('slow');},3400);

  


</script>
@endsection