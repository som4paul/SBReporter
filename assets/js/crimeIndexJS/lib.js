function numberFiledValidate(event) {
    if(!(event.which>=48 && event.which<=57) && event.which != 0 && event.which != 8) {
        event.preventDefault();
    }
}

//geolocation API

//Following two variable is for use of click event on map.
var customLatLng;
var customMarker;

function myMap(lati, longi) {
		 var myLatLng = {lat: lati, lng: longi};
			var map = new google.maps.Map(document.getElementById('googleMap'), {
					 zoom: 16,
					 center: myLatLng
				 });

				 var marker = new google.maps.Marker({
					 position: myLatLng,
					 map: map
				 });
				 customMarker = new google.maps.Marker({
					 position: myLatLng,
					 map: map
				 });

google.maps.event.addListener(map, 'click', function(event) {
var latLong = event.latLng.lat() + ", " + event.latLng.lng();

//Placing a marker in map on click event. User will see a marker whereever they click in.
customLatLng = {lat: event.latLng.lat(), lng: event.latLng.lng()};
customMarker.setMap(null);
customMarker = new google.maps.Marker({
	 position: customLatLng,
	 map: map
});
$('#lat').val(event.latLng.lat());
$('#long').val(event.latLng.lng());
});

$('#mapModal').on('shown.bs.modal', function () {
	 google.maps.event.trigger(map, 'resize');
	 map.setCenter(new google.maps.LatLng(lati, longi));
})

}

var callMap = function() {
var startPos;
var geoOptions = {
  enableHighAccuracy: true
}

var geoSuccess = function(position) {
	 startPos = position;
	 var lat = startPos.coords.latitude;
	 var long = startPos.coords.longitude;
	 console.log(lat+", "+long);
	 myMap(lat, long);
};
var geoError = function(error) {
  console.log('Error occurred. Error code: ' + error.code);
  // error.code can be:
  //   0: unknown error
  //   1: permission denied
  //   2: position unavailable (error response from location provider)
  //   3: timed out
};

navigator.geolocation.getCurrentPosition(geoSuccess, geoError, geoOptions);
};