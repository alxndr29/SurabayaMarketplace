@extends('template.blank_userumum')
@section('content')
<h1 class="h3 mb-4 text-gray-800">Detail Toko</h1>
@if(Session::has('sukses'))
<div class="alert alert-success"> {{ Session::get('sukses') }}</div>
@endif
@if(Session::has('gagal'))
<div class="alert alert-danger"> {{ Session::get('gagal') }}</div>
@endif
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="p-2">
                        <img src="{{asset('template/img/undraw_profile_1.svg')}}" style="width: 150px; height: 150px;">
                    </div>
                    <div class="p-2">
                        <div class="mx-auto">
                            <div class="row">
                                <h4>{{$data->name}}</h4>
                            </div>
                            <div class="row">
                                <p>Total Produk Yang Terjual: {{$jumlah_terjual}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="tab-produk" data-toggle="tab" href="#produk" role="tab" aria-controls="home" aria-selected="true">Produk</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="tab-info" data-toggle="tab" href="#info" role="tab" aria-controls="profile" aria-selected="false">Info Penjual</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="tab-jadwal" data-toggle="tab" href="#jadwal" role="jadwal" aria-controls="profile" aria-selected="false">Jadwal</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="produk" role="tabpanel" aria-labelledby="tab-produk">
                       
                        <div class="d-flex flex-row mt-1">
                            @foreach ($product as $key => $value)
                            <div class="p-2">
                                <div class="card h-100 p-2" style="width: 18rem;">
                                    <img class="card-img-top mx-auto" src="{{asset('product_picture/'.$value->picture)}}" alt="Card image cap" style="width: 200px; height: 200px;">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$value->name}}</h5>
                                        <p class="card-text">Rp. {{number_format($value->price)}}</p>
                                        <a href="{{url('user/product/detail/'.$value->idproduct)}}" class="btn btn-primary">Detail</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        {{ $product->links() }}
                    </div>
                    <div class="tab-pane fade" id="info" role="tabpanel" aria-labelledby="tab-info">
                        <br>
                        <div class="row p-2">
                            <div class="col">
                                <b> Deskripsi </b>
                                <br>
                                <p> {{$data->description}}</p>
                                <b> Jam Buka - Tutup </b>
                                <br>
                                <p> {{$data->open_hours}} - {{$data->close_hours}}</p>
                                <b> Alamat </b>
                                <br>
                                <p> {{$data->address}}</p>
                                <b> Phone </b>
                                <br>
                                <p> {{$data->phone}}</p>
                            </div>
                            <div class="col">
                                <b> Geolocation </b>
                                <br>
                                <div id="map" style="width: 500px; height: 250px;"></div>
                                <br>
                                <a class="btn btn-primary" target="_blank" href="https://www.google.com/maps/search/?api=1&query={{$data->latitude}}8%2C{{$data->longitude}}">Petunjuk Arah</a>
                            </div>
                            <div class="col">
                                <!-- <b> Deskripsi </b>
                                <br>
                                <b> Deskripsi </b>
                                <br>
                                <b> Deskripsi </b>
                                <br> -->
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade show" id="jadwal" role="tabpanel" aria-labelledby="tab-produk">
                        <div id='calendar' class="p-5">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modal-preview" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="" id="formjadwal">
                @csrf
                @method('put')
                <div class="modal-body">
                    <div class="form-group">
                        <label>Judul</label>
                        <input type="text" class="form-control" required name="title" id="previewJudul" readonly>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Mulai</label>
                        <input type="text" class="form-control" required id="previewTanggal" readonly>
                    </div>
                    <div class="form-group">
                        <label>Mulai</label>
                        <input type="text" class="form-control" required id="previewJamMulai" readonly>
                    </div>
                    <div class="form-group">
                        <label>Berakhir</label>
                        <input type="text" class="form-control" required id="previewJamAkhir" readonly>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <input type="text" class="form-control" required id="previewStatus" readonly>
                    </div>
                    <div class="form-group">
                        <label>Catatan</label>
                        <input type="text" class="form-control" required name="catatan">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Plot Jadwal</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
        $.ajax({
            url: "{{route('getjadwalajax.user',['id'=>$data->idshop])}}",
            method: 'GET',
            success: function(response) {
                data = response;
                console.log(data);
            },
            error: function(error) {
                console.log(error);
            }
        });
    });

    function initMap() {
        // The location of Uluru
        const uluru = {
            lat: Number("{{$data->latitude}}"),
            lng: Number("{{$data->longitude}}")
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
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: "{{route('getjadwalajax.user',['id'=>$data->idshop])}}",
            dayMaxEventRows: true,
            views: {
                timeGrid: {
                    dayMaxEventRows: 6 // adjust to 6 only for timeGridWeek/timeGridDay
                }
            },
            eventClick: function(info) {
                // alert('Event: ' + info.event.title);
                // alert('id: ' + info.event.id);
                loadModal(info.event.id);
            }
        });
        calendar.render();
    });

    function loadModal(id) {
        $.each(JSON.parse(data), function(index, item) {
            if (item.id == id) {
                if (item.status == "kosong") {
                    $("#previewJudul").val(item.title);
                    $("#previewTanggal").val(item.start);
                    $("#previewJamMulai").val(item.jam_mulai);
                    $("#previewJamAkhir").val(item.jam_akhir);
                    $("#previewStatus").val(item.status);
                    $("#modal-preview").modal('show');
                    $("#formjadwal").attr('action', "{{url('user/jadwal/update')}}" + "/" + id);
                } else {
                    swal('Slot sdh penuh. Silahkan pilih yang lain');
                }
            }
        });
    }
</script>
@endsection