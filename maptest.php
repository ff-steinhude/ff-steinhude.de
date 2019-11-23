<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Simple markers</title>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        #map {
            height: 100%;
        }
    </style>
</head>
<body>
<div id="map"></div>
<script>

    function initMap() {
        var myLatLng = {lat: -25.363, lng: 131.044};
        var myLatLng1 = {lat: -22.363, lng: 131.044};

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 4,
            center: myLatLng
        });

        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            title: 'Hello World!',
            label: 'test1'
        });
        var marker1  = new google.maps.Marker({
            position: myLatLng1,
            map: map,
            title: 'Hello World!'
        });
    }

</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBUJ1QUjzX8BqIRnKVFZ8Ht2zFIPWzGHq8&signed_in=true&callback=initMap"></script>
</body>
</html>