          function initMap() {
             let myLatLng = {lat: 27.4368, lng: 85.0026};
             let destination = {lat: 27.4390, lng: 85.0057};

              let map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: myLatLng
              });

              let desitinationMarker = new google.maps.Marker({
                position: destination,
                map: map,
                title: "Point to your location!",
                draggable: true
              });

              google.maps.event.addListener(desitinationMarker, 'dragend', function(event) {
                let distance = google.maps.geometry.spherical.computeDistanceBetween (event.latLng, originMarker.getPosition());
                destination = event.latLng;

                linePath.setMap(null);

                linePath = new google.maps.Polyline({
                  path: [destination, myLatLng],
                  geodesic: true,
                  strokeColor: '#FF0000'
                });

                linePath.setMap(map);
              });

              let input = document.getElementById('search');
              // map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

              let searchBox = new google.maps.places.SearchBox((input));

              google.maps.event.addListener(searchBox, 'places_changed', function() {
                let places = searchBox.getPlaces();
              });
            }