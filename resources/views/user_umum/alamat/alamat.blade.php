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
        <button type="button" data-toggle="modal" data-target="#add-alamat" class="btn btn-primary">
            Tambah
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Alamat</th>
                        <th>Telepon</th>
                        <th>Detail</th>
                        <th>Hapus</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $value)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$value->alamat}}</td>
                        <td>{{$value->telepon}}</td>
                        <td>
                            <a href="{{route('alamatshow.user',['id' => $value->idalamat])}}" class="btn btn-success btn-circle">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                        <td>
                            <button type="button" class="btn btn-warning btn-circle">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="add-alamat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Alamat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('alamatstore.user')}}">
                    @csrf
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" class="form-control" name="alamat" required>
                    </div>
                    <div class="form-group">
                        <label>Telepon</label>
                        <input type="number" class="form-control" name="telepon" required>
                    </div>
                    <div class="form-group">
                        <label>Your Location</label>
                        <div id="map" style="width:100%;height:200px;"></div>
                    </div>
                    <input type="hidden" name="latitude" id="latitude">
                    <input type="hidden" name="longitude" id="longitude">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
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