@extends('template.blank_userumum')
@section('content')
<h1 class="h3 mb-4 text-gray-800">Alamat</h1>
@if(Session::has('sukses'))
<div class="alert alert-success"> {{ Session::get('sukses') }}</div>
@endif
@if(Session::has('gagal'))
<div class="alert alert-danger"> {{ Session::get('gagal') }}</div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Alamat</h6>
    </div>
    <div class="card-body">
        <form method="post" action="{{route('alamatupdate.user',$data->idalamat)}}">
            @csrf
            @method('put')
            <div class="form-group">
                <label>Alamat</label>
                <input type="text" class="form-control" name="alamat" required value="{{$data->alamat}}">
            </div>
            <div class="form-group">
                <label>Telepon</label>
                <input type="number" class="form-control" name="telepon" required value="{{$data->telepon}}">
            </div>
            <div class="form-group">
                <label>Your Location</label>
                <div id="map" style="width:100%;height:200px;"></div>
            </div>
            <input type="hidden" name="latitude" id="latitude" value="{{$data->latitude}}">
            <input type="hidden" name="longitude" id="longitude" value="{{$data->longitude}}">
            <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
    </div>
</div>

@endsection
@section('script')
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1MgLuZuyqR_OGY3ob3M52N46TDBRI_9k&callback=initMap"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#dataTable').DataTable();
        initMap(parseFloat("{{$data->latitude}}"), parseFloat("{{$data->longitude}}"));
    });

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