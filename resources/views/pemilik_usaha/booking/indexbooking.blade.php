@extends('template.blank_pemilikusaha')
@section('content')
<h1 class="h3 mb-4 text-gray-800">History Booking</h1>
@if(Session::has('sukses'))
<div class="alert alert-success"> {{ Session::get('sukses') }}</div>
@endif
@if(Session::has('gagal'))
<div class="alert alert-danger"> {{ Session::get('gagal') }}</div>
@endif
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">History Booking</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Booking</th>
                        <th>Nama Produk</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Tanggal & Waktu Pengambilan</th>
                        <th> Detail </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $value)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$value->idbooking}}</td>
                        <td>{{$value->name_product}}</td>
                        <td>{{$value->jumlah}}</td>
                        <td>{{$value->total_harga}}</td>
                        <td>{{$value->date_pengambilan}} {{$value->time_pengambilan}}</td>
                        <td>
                            <button type="button" data-toggle="modal" data-target="#detail-booking-{{$value->idbooking}}" class="btn btn-warning btn-circle">
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
<div class="modal fade" id="detail-booking-{{$value->idbooking}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Booking</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- <form method="post" action="{{route('bookingstore.user')}}"> -->
            <div class="modal-body">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nama Customer</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" required name="namaCustomer" value="{{$value->name_customer}}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nama Usaha</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" required name="namaUsaha" readonly value="{{$value->nama_usaha}}">
                                <!-- <input type="hidden" name="idshop" value="{{$value->nama_usaha}}"> -->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nama Produk</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" required name="namaProduk" readonly value="{{$value->name_product}}">
                                <!-- <input type="hidden" name="idproduct" value="{{$value->name_product}}"> -->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Harga</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" required name="hargaProduk" value="{{$value->harga}}" id="hargaProduk" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Jumlah</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" required name="jumlah" id="jumlah" value="{{$value->jumlah}}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Total Harga</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" required name="totalHarga" id="totalHarga" readonly value="{{$value->total_harga}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Pembayaran</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" required name="pembayaran" value="{{$value->metode_payment}}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Pengiriman</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" required name="pengiriman" value="{{$value->metode_pengiriman}}" readonly>
                            </div>
                        </div>

                    </div>
                    <div class="col">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Alamat Toko</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="3" readonly name="alamat">{{$value->alamat}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Tanggal Pemesanan</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" required value="{{$value->date_booking}}" readonly name="tanggalPemesanan">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Tanggal Pengambilan</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" required name="tanggalPengambilan" value="{{$value->date_pengambilan}}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Waktu Pengambilan</label>
                            <div class="col-sm-10">
                                <input type="time" class="form-control" required name="waktuPengambilan" value="{{$value->time_pengambilan}}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Note</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="3" name="note" readonly>{{$value->note}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" required name="status" value="{{$value->status}}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                @if($value->status == "Menunggu Barang Diambil")
                <form method="post" action="{{route('bookingupdate.shop',['id' => $value->idbooking])}}" onsubmit="return confirm('Apakah anda yakin ingin menyelesaikan booking ini?');">
                    @csrf
                    @method('put')
                    <button type="submit" class="btn btn-primary">Selesaikan</button>
                </form>
                @endif
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            <!-- </form> -->
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