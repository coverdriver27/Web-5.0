<!DOCTYPE html>
<?php
  require "header.php";

?>

<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <title>Ping Maps</title>
    <style>
        /* Set the size of the div element that contains the map */
        h3 {
            text-align: center;
        }

        #map {
            height: 400px; /* The height is 400 pixels */
            width: 100%; /* The width is the width of the web page */
        }
    </style>
</head>
<html>
<body>

    <?php 
	$data=$_GET["mn"];
	echo'<h3> '.$data.' Map</h3>'?>
    <!--The div element for the map -->
    <div id="map"></div>

    <script>
        var customLabel = {
            restaurant: {
                label: 'R'
            },
            bar: {
                label: 'B'
            }
        };

        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: new google.maps.LatLng(34.0522, -118.2437),
                zoom: 12
            });
            var infoWindow = new google.maps.InfoWindow;

            // Change this depending on the name of your PHP or XML file
            downloadUrl('embrace/map.emb.php?mn=<?php $data=$_GET["mn"]; echo''.$data.' '?>', function (data) {
                var xml = data.responseXML;
                var markers = xml.documentElement.getElementsByTagName('marker');
                Array.prototype.forEach.call(markers, function (markerElem) {
                    var id = markerElem.getAttribute('id');
                    var name = markerElem.getAttribute('name');
                    var address = markerElem.getAttribute('address');
                    var type = markerElem.getAttribute('type');
                    var point = new google.maps.LatLng(
                        parseFloat(markerElem.getAttribute('lat')),
                        parseFloat(markerElem.getAttribute('lng')));

                    var infowincontent = document.createElement('div');
                    var strong = document.createElement('strong');
                    strong.textContent = name
                    infowincontent.appendChild(strong);
                    infowincontent.appendChild(document.createElement('br'));

                    var text = document.createElement('text');
                    text.textContent = address
                    infowincontent.appendChild(text);
                    var icon = customLabel[type] || {};
                    var marker = new google.maps.Marker({
						draggable:true,
                        map: map,
                        position: point, //point
                        label: icon.label
                    });

				
			
                    marker.addListener('click', function () {
                        infoWindow.setContent(infowincontent);
                        infoWindow.open(map, marker);
                    });
                });
            });


					//code
					// This event listener calls addMarker() when the map is clicked.
					google.maps.event.addListener(map, 'click', function(event) {
					 addMarker(event.latLng, map);
					//code


					});
        }

			//code// Adds a marker to the map.
		function addMarker(location, map) {
		// Add the marker at the clicked location, and add the next-available label
		// from the array of alphabetical characters.
			var marker = new google.maps.Marker({
			draggable:true,
			position: location,
			map: map
			});
		}

				google.maps.event.addDomListener(window, 'load', initialize);//code



        function downloadUrl(url, callback) {
            var request = window.ActiveXObject ?
                new ActiveXObject('Microsoft.XMLHTTP') :
                new XMLHttpRequest;

            request.onreadystatechange = function () {
                if (request.readyState == 4) {
                    request.onreadystatechange = doNothing;
                    callback(request, request.status);
                }
            };

            request.open('GET', url, true);
            request.send(null);
        }

        function doNothing() { }
    </script>
    <!--Load the API from the specified URL
    * The async attribute allows the browser to render the page while the API loads
    * The key parameter will contain your own API key (which is not needed for this tutorial)
    * The callback parameter executes the initMap() function
    -->
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyACZxALFVonjctEnHGw12AokBeMPEeKS2Y&callback=initMap">
    </script>

</body>
</html>