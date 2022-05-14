@extends('template.blank_userumum')
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
                        <td><a href="{{route('home.detailshop',['id' => $value->idshop])}}">{{$value->nameshop}}</a></td>
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
                    <label>User</label>
                    <input type="text" class="form-control" value="{{$value->nameuser}}" required readonly>
                </div>
                <div class="form-group">
                    <label>Seller</label>
                    <input type="text" class="form-control" value="{{$value->nameshop}}" required readonly>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" class="form-control" value="{{$value->address}}" required readonly>
                </div>
                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" class="form-control" value="{{$value->phone}}" required readonly>
                </div>
                <a class="btn btn-primary" target="_blank" href="https://www.google.com/maps/search/?api=1&query={{$value->latitude}}8%2C{{$value->longitude}}">Petunjuk Arah</a>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach


@endsection
@section('script')

<script type="text/javascript">
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>
@endsection