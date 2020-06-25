@extends('layouts.default')
@section('content')

<div class="col-12">
  <div id="accordion">
    <div class="card bg-white ">
      <div class="card-header bg-white" id="headingOne">
        <h5 class="mb-0">
          <a class="btn btn-secondary" href="{{ action('Admin\PlaceController@index') }}">
            <i class="fa fa-arrow-circle-left"></i>
          </a>
          <button class="btn btn-link text-dark" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
            aria-controls="collapseOne">
            <h3>
              <strong class="text-warning">
                Edit: {{ $place->name }}
                <input type="hidden" value="{{ $place->id }}" id="place_id">
              </strong>
            </h3>
          </button>
        </h5>
      </div>
      <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
        <div class="card-body">

          <form method="post" action="{{ action('Admin\PlaceController@update', $place->id) }}">
            @method('put')
            @csrf
            <div class="row">
              <div class="col-md-4 mb-3">
                <label for="place" class="text-md-left text-white">{{ __('Place Name') }}</label>
                <input id="place" type="text" class="form-control @error('place') is-invalid @enderror" name="place"
                  value="{{ $place->name }}" autocomplete="off" autofocus>

                @error('place')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="col-md-4 mb-3">
                <label for="latitude" class="text-md-left">{{ __('Latitude') }}</label>
                <input id="latitude" type="text" class="form-control @error('latitude') is-invalid @enderror"
                  name="latitude" value="{{ $place->latitude }}" autocomplete="off" autofocus>

                @error('latitude')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="col-md-4 mb-3">
                <label for="longitude" class="text-md-left">{{ __('Longitude') }}</label>

                <input id="longitude" type="text" class="form-control @error('longitude') is-invalid @enderror"
                  name="longitude" value="{{ $place->longitude }}" autocomplete="off" autofocus>

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
                  <label class=" text-md-left">{{ __('Coordinates') }}</label>

                  <div class="mapContainer" style="width:100%;">
                    <div id="mapId" style="height: 400px; width:100%; overflow: hidden;"></div>
                  </div>
                </div>
                <div id="tabs" class="project-tab col-md-6 ml-auto mt-4"
                  style="background-color:white; border-radius: 20px; height: 90%; ">
                  <div class="container">
                    <input type="hidden" id="distance">
                    <div class="row ">
                      <div class="col-md-12">
                        <nav>
                          <div class="nav nav-tabs nav-fill p-2" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active btn btn-primary mr-2" id="nav-home-tab" data-toggle="tab"
                              href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Edit Price</a>
                          </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                          <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                            aria-labelledby="nav-home-tab">
                            <table class="table" cellspacing="0">
                              <form action="{{ action('Admin\PlaceController@update',$place->id) }}" method="put">

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
                                    <td><input class="form-control price"
                                        name="prices[{{ $item->id }}][{{ $medium->id }}]"
                                        data-id="{{ [$item->id][$medium->id]['price'] ?? '-' }}"
                                        id="price_{{ $item->id }}_{{ $medium->id }}">
                                    </td>
                                    @endforeach
                                  </tr>
                                  @endforeach
                                </tbody>
                              </form>
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
              <button class="btn btn-success">Update Place</button>
            </div>
          </form>

        </div>
      </div>
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
			$(`#price_${item_id}_${medium_id}`).val(parseInt(price)||'-')
		})
	})
} 
var place_id = $('#place_id').val()
getAmountsForPlace(place_id)
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