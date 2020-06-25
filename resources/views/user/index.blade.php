@extends('layouts.app')

@section('content')

{{-- Price Table of Different location --}}
<form action="{{action('HomeController@checkout')}}" method="get">
  @csrf
  <section id="tabs" class="project-tab col-md-4 pt-2"
    style="position: absolute; top:8.5%; right:0.3%; z-index: 1000; background-color:white;">
    <a class="btn btn-danger sm rounded-circle closeTab text-white" style="right:10px; position:absolute;">X</a>
    <div class="container pt-3">
      <input type="hidden" id="distance">
      <div class="d-flex">
        <h3 class="location"></h3>
      </div>
      <div class="row">
        <div class="col-md-12">
          <nav>
            <div class="nav nav-tabs nav-fill p-2" id="nav-tab" role="tablist">
              <a class="nav-item nav-link active btn btn-primary mr-2" id="nav-home-tab" data-toggle="tab"
                href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Per Medium</a>
              <a class="nav-item nav-link btn btn-success" id="nav-profile-tab" data-toggle="tab" href="#nav-profile"
                role="tab" aria-controls="nav-profile" aria-selected="false">Perseptic</a>
            </div>
          </nav>
          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
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
                        {{  '-' }}
                      </span>
                    </td>
                    @endforeach
                  </tr>
                  @endforeach
                </tbody>

              </table>
              <input type="hidden" name="selectedPlace" id="selectedPlace">
              <input type="hidden" name="selectedLat" id="selectedLat">
              <input type="hidden" name="selectedLng" id="selectedLng">
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
    <div class="text-center pb-3 checkout">
      <button class="btn btn-primary">Order Now</a>
    </div>
  </section>
</form>

{{-- <div class="row mt-5 pl-2" style="position:absolute; z-index:2000; width:40%;">
  <div class="col-md-6 mt-5">
    <label class="text-danger">
      <h4><b>Choose Your Location</b></h4>
    </label>
    <ul>
      @foreach($places as $place)
    <li class="list"  data-id="{{ $place->id }}}" data-lat="{{ $place->latitude }}" data-lng="{{ $place->longitude }}"
data-name="{{$place->name}}" >{{ $place->name }}</li>
@endforeach
</ul>
</div>
</div> --}}
{{-- Map --}}
<div class="map">
  <div id="mapid">
  </div>
</div>
{{-- /Map --}}

{{-- Selection Division --}}


<div class="p-2" style="position:absolute; left:1%; bottom:3%; z-index:2000;">
  <button class="btn btn-danger" style="width:100%;" id="setMarker">
    <i class="ni ni-pin-3"></i> Set Marker
  </button>
</div>

<!-- Modal -->

@endsection
@section('scripts')
<script src='https://unpkg.com/axios/dist/axios.min.js'> </script>


<script>
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
			$(`#price_${item_id}_${medium_id}`).text(price)
      $('.location').text("Near: "+name);
		})
	})
}

</script>



<script>
  $('document').ready(function () {
    $('#tabs').hide();
	 let markers = {};
	 axios.get('https://global.test/getPlaces')
		.then(function (response) {
			let places = response.data;
			var mymap = L.map('mapid').setView([27.4293, 85.0313], 15);
			places.forEach(element => {
        markers[element.id]={
          lat:element.latitude,
          lng:element.longitude,
          name:element.name,
          id:element.id
        }
				// markers[element.id] = L.marker([element.latitude, element.longitude], {
				// 	place_id: element.id
				// }).addTo(mymap).on('click', onClick);
				// markers[element.id].bindPopup(`<b>${element.name}</b>`).openPopup();
			});
        let dragMarker;
        let  nearestMarker =null;
      
      // get latitude and longitude on dragging marker
      function getLatLng(marker) {
       let lng = this.getLatLng().lng;
       let lat = this.getLatLng().lat;
      
      findNearestPlace(lat,lng);
    }


    function findNearestPlace(lat,lng){
      let nearestIndex = null;
         let nearestDistance = 1000;
    
         //calculating distance between markers

      for(marker in markers){
        let d =Math.sqrt(Math.pow(lng - markers[marker].lng,2) + Math.pow(lat-markers[marker].lat,2));
          console.log(d)
        if(nearestDistance>d) {
          nearestDistance = d;
          nearestIndex = marker;
        }
       
      }
        $("#selectedPlace").val(nearestIndex)
      // checking nearest marker
        if(nearestMarker){
          nearestMarker.remove();
        }
        nearestMarker= L.marker([markers[nearestIndex].lat,markers[nearestIndex].lng]).addTo(mymap).bindPopup(`<b>${markers[nearestIndex].name}</b>`).openPopup();
		    getAmountsForPlace(nearestIndex);
        $('#tabs').show();
    }

    // Map
      
			L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
				attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
				maxZoom: 18,
				id: 'mapbox/streets-v11',
				tileSize: 512,
				zoomOffset: -1,
				accessToken: 'pk.eyJ1IjoicnVwZXNoLTEwIiwiYSI6ImNrNnJyeDRzNTA5OTQzbHJ6ODA1eGxoMDcifQ.3OipB5IRVOeLv-r2Q4lQIA'
			}).addTo(mymap);

      L.control.scale().addTo(mymap);
      var searchControl = new L.esri.Controls.Geosearch({
        geocodingQueryParams: {countrycodes: 'npl'}
      }).addTo(mymap);

        var results = new L.LayerGroup().addTo(mymap);

        searchControl.on('results', function(data){
          results.clearLayers();
          for (var i = data.results.length - 1; i >= 0; i--) {
          if(dragMarker){
            dragMarker.setLatLng(data.results[i].latlng);
          }
            dragMarker = results.addLayer(L.marker(data.results[i].latlng,{
              draggable:true,
              icon:greenIcon,
            }).addTo(mymap).bindPopup("your search").openPopup().on('dragend',getLatLng))

            findNearestPlace(data.results[i].latlng.lat,data.results[i].latlng.lng)
          }
      })

setTimeout(function(){$('.pointer').fadeOut('slow');},3400);

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else {
     alert("Geolocation is not supported by this browser.");
  }
}
var greenIcon = new L.Icon({
  iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
  shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
  iconSize: [25, 41],
  iconAnchor: [12, 41],
  popupAnchor: [1, -34],
  shadowSize: [41, 41]
});

function showPosition(position) {
  // position.coords.latitude
  // position.coords.longitude;
  $('#setMarker').on('click',function(){
    if(dragMarker){
      dragMarker.setLatLng([position.coords.latitude,position.coords.longitude])
    }
      dragMarker =L.marker([position.coords.latitude,position.coords.longitude],{
        draggable:true,
        icon:greenIcon,
      }).addTo(mymap).bindPopup("Your Location").openPopup().on('dragend',getLatLng)
    })
  }
  getLocation()
})
  $('#selectedLat').val(dragMarker.getLatLng().lat)
  $('#selectedLng').val(dragMarker.getLatLng().lng)
	//load data on table from specific location
	function onClick(e) {
		let place_id = $(this)[0]['options']['place_id'];
		getAmountsForPlace(place_id);
    $('#tabs').show();

	}
  $('.closeTab').on('click',function(){
    $('#tabs').hide();
  })



  
  });  
</script>
@endsection