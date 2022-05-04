@extends('template.blank_pemilikusaha')
@section('content')
<h1 class="h3 mb-4 text-gray-800">Jadwal</h1>
@if(Session::has('sukses'))
<div class="alert alert-success"> {{ Session::get('sukses') }}</div>
@endif
@if(Session::has('gagal'))
<div class="alert alert-danger"> {{ Session::get('gagal') }}</div>
@endif
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="d-flex justify-content-between">
            <div class="p-2">
                <h6 class="font-weight-bold text-primary mx-auto">Jadwal</h6>
            </div>
            <div class="p-2">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                    Buat Jadwal
                </button>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div id='calendar'></div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Jadwal</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Mulai</th>
                        <th>Akhir</th>
                        <th>Seller</th>
                        <th>Status</th>
                        <th> Detail </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $value)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$value->tanggal}}</td>
                        <td>{{$value->jam_mulai}}</td>
                        <td>{{$value->jam_akhir}}</td>
                        <td>{{$value->nameshop}}</td>
                        <td>{{$value->status}}</td>
                        <td>
                            <button type="button" data-toggle="modal" data-target="#detail-booking-{{$value->idjadwal}}" class="btn btn-warning btn-circle">
                                <i class="fas fa-edit"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Booking -->
@foreach ($data as $key => $value)
<div class="modal fade" id="detail-booking-{{$value->idjadwal}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Jadwal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="text" class="form-control" value="{{$value->tanggal}}" required readonly>
                </div>
                <div class="form-group">
                    <label>Mulai</label>
                    <input type="text" class="form-control" value="{{$value->jam_mulai}}" required readonly>
                </div>
                <div class="form-group">
                    <label>Akhir</label>
                    <input type="text" class="form-control" value="{{$value->jam_akhir}}" required readonly>
                </div>
                <div class="form-group">
                    <label>Catatan</label>
                    <input type="text" class="form-control" value="{{$value->catatan}}" required readonly>
                </div>
                <div class="form-group">
                    <label>Seller</label>
                    <input type="text" class="form-control" value="{{$value->nameshop}}" required readonly>
                </div>
                <div class="form-group">
                    <label>User</label>
                    <input type="text" class="form-control" value="{{$value->nameuser}}" required readonly>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{route('storejadwal.shop')}}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Judul</label>
                        <input type="text" class="form-control" required name="judul">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Mulai</label>
                        <input type="Date" class="form-control" required name="tanggal">
                    </div>
                    <div class="form-group">
                        <label>Jam Mulai</label>
                        <input type="time" class="form-control" required name="jamMulai">
                    </div>
                    <div class="form-group">
                        <label>Waktu Pertemuan (Menit)</label>
                        <input type="number" class="form-control" required name="waktupertemuan">
                    </div>
                    <div class="form-group">
                        <label>Jumlah Slot</label>
                        <input type="number" class="form-control" required name="slot">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
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
            <form method="post" action="{{route('storejadwal.shop')}}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Judul</label>
                        <input type="text" class="form-control" required name="judul" id="previewJudul">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Mulai</label>
                        <input type="text" class="form-control" required name="tanggal" id="previewTanggal">
                    </div>
                    <div class="form-group">
                        <label>Jam Mulai</label>
                        <input type="text" class="form-control" required name="jamMulai" id="previewJamMulai">
                    </div>
                    <div class="form-group">
                        <label>Jam Akhir</label>
                        <input type="text" class="form-control" required name="waktupertemuan" id="previewJamAkhir">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <input type="numbtexter" class="form-control" required name="slot" id="previewStatus">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    var data;
    $(document).ready(function() {
        $('#dataTable').DataTable();
        $.ajax({
            url: "{{route('listjadwal.shop')}}",
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

    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: "{{route('listjadwal.shop')}}",
            dayMaxEventRows: true,
            views: {
                timeGrid: {
                    dayMaxEventRows: 6 // adjust to 6 only for timeGridWeek/timeGridDay
                }
            },
            eventClick: function(info) {
                alert('Event: ' + info.event.title);
                alert('id: ' + info.event.id);
                loadModal(info.event.id);
            }
        });
        calendar.render();
    });

    function loadModal(id) {
        alert('modal masuk sini');
        $.each(JSON.parse(data), function(index, item) {
            if (item.id == id) {
                $("#previewJudul").val(item.title);
                $("#previewTanggal").val(item.start);
                $("#previewJamMulai").val(item.jam_mulai);
                $("#previewJamAkhir").val(item.jam_akhir);
                $("#previewStatus").val(item.status);
                $("#modal-preview").modal('show');
            }
        });
    }
</script>
@endsection