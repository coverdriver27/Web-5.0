function initMap() 
{
  var myLatLng = {lat: 34.2220, lng: -118.503};
  var myLatLng1 = {lat: 34.5, lng: -118.7};


  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 12,
    center: myLatLng
  });

  var marker = new google.maps.Marker({
    position: myLatLng,
    map: map,
    title: 'Hello World!'

  });
  var marker = new google.maps.Marker({
    position: myLatLng1,
    map: map,
    title: 'Hello'
    
  });
  marker.setMap(map);
}