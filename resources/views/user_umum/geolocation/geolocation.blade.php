@extends('template.blank_userumum')
@section('content')
<h1 class="h3 mb-4 text-gray-800">Geolocationd</h1>
@if(Session::has('sukses'))
<div class="alert alert-success"> {{ Session::get('sukses') }}</div>
@endif
@if(Session::has('gagal'))
<div class="alert alert-danger"> {{ Session::get('gagal') }}</div>
@endif
<div class="row">
    <div class="d-flex flex-row">
        <div class="p-2">
            <div class="form-group">
                <input type="number" id="rangeNumber" class="form-control" placeholder="max">
            </div>
        </div>
        <div class="p-2">
            <button type="button" id="btnSearchRange" class="btn btn-primary">Cari</button>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div id="map" style="width:auto; height: 500px;">

        </div>
    </div>
</div>
@endsection
@section('script')
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1MgLuZuyqR_OGY3ob3M52N46TDBRI_9k&callback=initMap"></script>
<script type="text/javascript">
    var lat_now = "";
    var lot_now = "";
    $(document).ready(function() {
        getLocation();

    });

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    }

    function showPosition(position) {
        // var test = "Latitude: " + position.coords.latitude +
        //     "<br>Longitude: " + position.coords.longitude;
        lat_now = (position.coords.latitude);
        lot_now = (position.coords.longitude);
        initMap(position.coords.latitude, position.coords.longitude);
    }
    $("#btnSearchRange").on('click', function() {

        search();
    });

    function search() {
        var range = $("#rangeNumber").val();

        initMap(lat_now, lot_now);
        // The location of Uluru
        const uluru = {
            lat: lat_now,
            lng: lot_now
        };
        // The map, centered at Uluru
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 15,
            center: uluru,
        });
        // The marker, positioned at Uluru
        const marker = new google.maps.Marker({
            label: 'Lokasi mu',
            position: uluru,
            map: map,
        });
        getDataPenjual();

        var marker_a, i;
        var infowindow_a = new google.maps.InfoWindow();
        $.ajax({
            url: "{{route('geolocationdata.user')}}",
            method: 'GET',
            success: function(response) {
                console.log(response);
                $.each(response, function(j, k) {
                    console.log(k.latitude + "/" + k.longitude);
                    if (haversine(lat_now, lot_now, parseFloat(k.latitude), parseFloat(k.longitude)) >= range) {
                        marker_a = new google.maps.Marker({
                            position: new google.maps.LatLng(parseFloat(k.latitude), parseFloat(k.longitude)),
                            map: map,
                            label: k.name
                        });

                        google.maps.event.addListener(marker_a, 'click', (function(marker_a, i) {
                            return function() {
                                infowindow_a.setContent('<h1>' +
                                    k.name + '</h1>' + '<br>' +
                                    k.address + '<br>' + 'Jarak: ' +
                                    haversine(lat_now, lot_now, parseFloat(k.latitude), parseFloat(k.longitude)) + " km." +
                                    '<br> <a class="btn btn-primary" target="_blank" href="https://www.google.com/maps/search/?api=1&query=' + k.latitude + '8%2C' + k.longitude + '">Petunjuk Arah</a>');
                                infowindow_a.open(map, marker_a);
                            }
                        })(marker_a, i));
                        i++;
                    }
                });
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    function initMap(lat, lot) {
        // The location of Uluru
        const uluru = {
            lat: lat,
            lng: lot
        };
        // The map, centered at Uluru
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 15,
            center: uluru,
        });
        // The marker, positioned at Uluru
        const marker = new google.maps.Marker({
            label: 'Lokasi mu',
            position: uluru,
            map: map,
        });
        getDataPenjual();

        var marker_a, i;
        var infowindow_a = new google.maps.InfoWindow();
        $.ajax({
            url: "{{route('geolocationdata.user')}}",
            method: 'GET',
            success: function(response) {
                console.log(response);
                $.each(response, function(j, k) {
                    console.log(k.latitude + "/" + k.longitude);
                    console.log(haversine(lat_now, lot_now, parseFloat(k.latitude), parseFloat(k.longitude)));

                    marker_a = new google.maps.Marker({
                        position: new google.maps.LatLng(parseFloat(k.latitude), parseFloat(k.longitude)),
                        map: map,
                        label: k.name
                    });

                    google.maps.event.addListener(marker_a, 'click', (function(marker_a, i) {
                        return function() {
                            infowindow_a.setContent('<h1>' +
                                k.name + '</h1>' + '<br>' +
                                k.address + '<br>' + 'Jarak: ' +
                                haversine(lat_now, lot_now, parseFloat(k.latitude), parseFloat(k.longitude)) + " km." +
                                '<br> <a class="btn btn-primary" target="_blank" href="https://www.google.com/maps/search/?api=1&query=' + k.latitude + '8%2C' + k.longitude + '">Petunjuk Arah</a>');
                            infowindow_a.open(map, marker_a);
                        }
                    })(marker_a, i));
                    i++;
                });
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    function getDataPenjual() {

    }

    function haversine(lat1, lon1, lat2, lon2) {
        function toRad(x) {
            return x * Math.PI / 180;
        }
        var R = 6371; // km
        var x1 = lat2 - lat1;
        var dLat = toRad(x1);
        var x2 = lon2 - lon1;
        var dLon = toRad(x2)
        var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
            Math.cos(toRad(lat1)) * Math.cos(toRad(lat2)) *
            Math.sin(dLon / 2) * Math.sin(dLon / 2);
        var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        var d = R * c;
        return d;
    }
</script>
@endsection
<!-- https://stackoverflow.com/questions/14560999/using-the-haversine-formula-in-javascript -->