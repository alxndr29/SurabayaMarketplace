@extends('template.blank_userumum')
@section('content')
<h1 class="h3 mb-4 text-gray-800">Order</h1>
@if(Session::has('sukses'))
<div class="alert alert-success"> {{ Session::get('sukses') }}</div>
@endif
@if(Session::has('gagal'))
<div class="alert alert-danger"> {{ Session::get('gagal') }}</div>
@endif
<!-- <?php echo $data; ?> -->
<div class="card">
    <div class="card-header">
        Daftar Order
    </div>
    <div class="card-body">
        @foreach($data as $key => $value)
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="p-1">
                        <b>Belanja</b>
                    </div>
                    <div class="p-1">
                        {{$value->tanggal}}
                    </div>
                    <div class="p-1">
                        <span class="badge badge-primary">{{$value->status_order}}</span>
                    </div>
                    <div class="p-1">
                        <span class="badge badge-primary">ID Transaksi: {{$value->idorder}}</span>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="p-1">
                        <b>Penjual: {{$value->nameshop}}</b>
                    </div>
                </div>
                <div class="d-flex border rounded">
                    <div class="p-1">
                        <img class="rounded" src="{{asset('product_picture/'.$value->picture)}}" alt="Card image cap" style="width: 150px; height: 150px;">
                    </div>
                    <div class="p-1">
                        {{$value->nameproduct}}
                        <br>
                        Rp. {{number_format($value->price)}}
                        <br>
                        + {{$value->total_product}} Produk Lainnya
                    </div>
                    <div class="p-1 mx-auto align-middle">
                        Total Belanja: {{number_format($value->total)}}
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    @if($value->status_order == "Menunggu Pembayaran")
                    <div class="p-1">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-bayar-{{$value->idorder}}">
                            Bayar
                        </button>
                    </div>
                    @endif
                    @if ($value->status_order == "Pesanan Dikirim")
                    <form method="post" action="{{route('ubahstatusorder.shop')}}">
                        @csrf
                        <input type="hidden" name="idorder" value="{{$value->idorder}}">
                        <input type="hidden" name="status" value="Sampai Tujuan">
                        <div class="p-1">
                            <button type="submit" class="btn btn-primary">Sampai Tujuan</button>
                        </div>
                    </form>
                    @endif
                    @if ($value->status_order == "Sampai Tujuan")
                    <form method="post" action="{{route('ubahstatusorder.shop')}}">
                        @csrf
                        <input type="hidden" name="idorder" value="{{$value->idorder}}">
                        <input type="hidden" name="status" value="Selesai">
                        <div class="p-1">
                            <button type="submit" class="btn btn-primary">Selesai</button>
                        </div>
                    </form>
                    @endif

                    @if($value->is_review == "false" && $value->status_order == "Selesai")
                    <div class="p-1">

                        <button type="button" class="btn btn-primary" onClick="review({{$value->idorder}})">Review</button>
                    </div>
                    @endif
                    <div class="p-1">
                        <button type="button" class="btn btn-primary" onClick="detail({{$value->idorder}})">Detail</button>
                    </div>
                </div>
            </div>
        </div>
        <br>
        @endforeach
    </div>
</div>
<!-- Mdoal Review -->
<div class="modal fade" id="modal-review" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Review</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="" id="form-review">
                @csrf
                <div class="row m-3">
                    <div class="table responsive">
                        <table class="table table-bordered " cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Image</th>
                                    <th>Nama</th>

                                    <th>Review</th>
                                    <th>Review</th>
                                </tr>
                            </thead>
                            <tbody id="list-product-review">

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Bayar -->
@foreach ($data as $key => $value)
<div class="modal fade" id="modal-bayar-{{$value->idorder}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Pembayaran ID Transaksi - {{$value->idorder}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{route('orderbayar.user',$value->idorder)}}" enctype='multipart/form-data'>
                @csrf
                @method('put')
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Pemilik Rekening</label>
                        <input type="text" class="form-control" name="namaPemilikRekening" required>
                    </div>
                    <div class="form-group">
                        <label>Nomor Rekening</label>
                        <input type="number" class="form-control" name="nomorRekening" required>
                    </div>
                    <div class="form-group">
                        <label>Example file input</label>
                        <input type="file" accept="image/*" class="form-control-file" name="image" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<!-- Modal Detail -->
<div class="modal fade" id="modaldetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col" id="order">

                    </div>
                    <div class="col" id="data">

                    </div>
                    <div class="col" id="alamat">

                    </div>
                    <div class="col" id="pembayaran">
                        a
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Image</th>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody id="list-product">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')

<script type="text/javascript">
    $(document).ready(function() {

    });

    function review(id) {
        $("#list-product-review").empty();
        $.ajax({
            url: "{{url('user/order/detailUser')}}/" + id,
            method: 'GET',
            success: function(response) {
                $.each(response.data_barang, function(i, k) {
                    var img = k.picture;
                    var url_image = "{{asset('')}}" + "product_picture/" + img;
                    $("#list-product-review").append(
                        '<tr>' +
                        '<td>' + (i + 1) + '</td>' +
                        '<td>' + '<img style="width:100px; height:100px;" src="' + url_image + '">' + '</td>' +
                        '<td>' + k.productname + '</td>' +
                        '<td>' + '<select name="rating[' + k.product_idproduct + ']" class="custom-select mr-sm-2">  <option value = "1" > <p> &#9734;</p> </option> <option value = "2" > <p> &#9734;</p> <p> &#9734;</p> </option><option value = "3" > <p> &#9734;</p><p> &#9734;</p><p> &#9734;</p> </option><option value = "4"> <p> &#9734;</p> <p> &#9734;</p> <p> &#9734;</p> <p> &#9734;</p> </option><option value = "5"> <p> &#9734;</p><p> &#9734;</p><p> &#9734;</p><p> &#9734;</p><p> &#9734;</p> </option> </select>' + '</td >' +
                        '<td>' + '<input name="komen[' + k.product_idproduct + ']" type="text" class="form-control" required>' + '</td >' +
                        '<tr>'
                    );
                });
            },
            error: function(error) {
                console.log(error);
            }
        });
        $("#form-review").attr('action', "{{url('user/review/store/')}}" + "/" + id);
        $("#modal-review").modal('show');
    }

    function detail(id) {
        $("#alamat").empty();
        $("#order").empty();
        $("#data").empty();
        $("#pembayaran").empty();
        $("#list-product").empty();
        $.ajax({
            url: "{{url('user/order/detailUser')}}/" + id,
            method: 'GET',
            success: function(response) {
                console.log(response);
                $("#alamat").append(
                    '<b> Data Alamat </b>' +
                    '<br>' +
                    response.alamat.alamat +
                    '<br>' +
                    response.alamat.telepon +
                    '<br>'
                    // + response.alamat.latitude + response.alamat.longitude
                );
                $("#order").append(
                    '<b> Data Toko </b>' +
                    '<br>' +
                    response.shop.name +
                    '<br>' +
                    response.shop.address +
                    '<br>' +
                    response.shop.phone
                    // + response.alamat.latitude + response.alamat.longitude
                );
                $("#data").append(
                    '<b> Data Order </b>' +
                    '<br>' +
                    response.order.tanggal +
                    '<br> Status: ' +
                    response.order.status_order +
                    '<br>'
                    // + response.alamat.latitude + response.alamat.longitude
                );
                if (response.payment == null) {
                    $("#pembayaran").append('<b> Belum Ada Data Pembayaran. </b>');
                } else {
                    $("#pembayaran").append(
                        '<b> Data Pembayaran </b>' +
                        '<br> Tanggal: ' +
                        response.payment.date +
                        '<br>' +
                        response.payment.nomor_rekening_pemilik + '<br>' + response.payment.nama_rekening_pemilik
                    );
                }
                $.each(response.data_barang, function(i, k) {
                    var img = k.picture;
                    var url_image = "{{asset('')}}" + "product_picture/" + img;
                    $("#list-product").append(
                        '<tr>' +
                        '<td>' + (i + 1) + '</td>' +
                        '<td>' + '<img style="width:100px; height:100px;" src="' + url_image + '">' + '</td>' +
                        '<td>' + k.productname + '</td>' +
                        '<td> Rp. ' + (k.subtotal / k.qty) + '</td>' +
                        '<td>' + k.qty + '</td>' +
                        '<td>Rp. ' + k.subtotal + '</td>' +
                        '<tr>'
                    );
                });

                $('#modaldetail').modal('show');
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
</script>
@endsection