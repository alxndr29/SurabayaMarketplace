@extends('template.blank_pemilikusaha')
@section('content')
<h1 class="h3 mb-4 text-gray-800">Shop Settings</h1>
<form method="post" action="{{route('shop.update',$data->idshop)}}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label>Shop Name</label>
        <input type="text" class="form-control" placeholder="Enter name" required name="shop_name" value="{{$data->name}}">
    </div>
    <div class="form-group">
        <label>Description</label>
        <textarea class="form-control" rows="3" required name="description">{{$data->description}}</textarea>
    </div>
    <div class="form-group">
        <label>Addres</label>
        <textarea class="form-control" rows="3" required name="address">{{$data->address}}</textarea>
    </div>
    <div class="form-group">
        <label>Open Hours</label>
        <input type="time" class="form-control" required name="open_hours" value="{{$data->open_hours}}">
    </div>
    <div class="form-group">
        <label>Close Hours</label>
        <input type="time" class="form-control" required name="close_hours" value="{{$data->close_hours}}">
    </div>
    <div class="form-group">
        <label>Phone</label>
        <input type="number" class="form-control" placeholder="Enter phone number" required name="phone" value="{{$data->phone}}">
    </div>
    <div class="form-group">
        <label>Your Location</label>
        <div id="map" style="width:100%;height:400px;"></div>
    </div>
    <input type="hidden" name="latitude" id="latitude" value="{{$data->latitude}}">
    <input type="hidden" name="longitude" id="longitude" value="{{$data->longitude}}">
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
@section('script')
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1MgLuZuyqR_OGY3ob3M52N46TDBRI_9k&callback=initMap"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#dataTable').DataTable();
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
        var test = "Latitude: " + position.coords.latitude +
            "<br>Longitude: " + position.coords.longitude;
        $("#latitude").val(position.coords.latitude);
        $("#longitude").val(position.coords.longitude);
        initMap(position.coords.latitude, position.coords.longitude);
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
            position: uluru,
            map: map,
        });
    }
</script>
@endsection